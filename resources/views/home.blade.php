@extends('layouts.app')

@section('content')
    <div class="page-content block" id="page-home">
        <!-- Header -->
        <div class="navy-blue text-white p-4 md:p-6 rounded-b-3xl shadow-lg">
            <div class="flex justify-between items-center mb-3 md:mb-4">
                <!-- Logo Judul -->
                <div class="flex items-center space-x-1">
                    <div class="relative inline-block">
                        <h1 class="text-lg md:text-xl font-bold relative z-10">Spendee</h1>
                        <div
                            class="absolute top-1/2 left-full -translate-x-2 -translate-y-1/2 w-6 h-6 bg-yellow-400 rounded-full flex items-center justify-center text-black font-bold text-sm z-0" style="margin-top: 3px;">
                            Q
                        </div>
                    </div>
                </div>

                <!-- Tanggal + Icon -->
                <div class="flex items-center space-x-2">
                    <div class="text-white/80 text-xs md:text-sm">Hai, {{ Auth::user()->name }}</div>
                </div>
            </div>


            <div class="bg-white/10 rounded-xl p-3 md:p-4 mb-3 md:mb-4">
                {{-- Header dengan ikon kalender dan tanggal --}}
                <div class="flex justify-between items-center">
                    <div class="text-xs md:text-sm text-white/80">Pengeluaran Hari Ini</div>
                    <div class="flex items-center text-xs md:text-sm text-white/70">
                        <i class="fas fa-calendar-alt mr-1 text-white/70"></i>
                        <span>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</span>
                    </div>
                </div>

                {{-- Total hari ini --}}
                <div class="text-xl md:text-2xl font-bold text-white">Rp {{ number_format($todayTotal, 0, ',', '.') }}</div>

                {{-- Perbandingan kemarin --}}
                <div class="mt-1 md:mt-2 flex justify-between items-center">
                    <div>
                        <div class="text-xs text-white/70">Kemarin</div>
                        <div class="text-xs md:text-sm font-medium text-white">Rp {{ number_format($yesterdayTotal, 0, ',', '.') }}</div>
                    </div>

                    @if($percentageChange !== 0)
                        <div class="{{ $percentageChange > 0 ? 'bg-red-500/90' : 'bg-green-500/90' }} text-white text-xs px-2 md:px-3 py-1 rounded-full flex items-center">
                            <i class="fas fa-arrow-{{ $percentageChange > 0 ? 'up' : 'down' }} mr-1"></i>
                            <span>{{ $percentageChange > 0 ? '+' : '' }}{{ $percentageChange }}%</span>
                        </div>
                    @else
                        <div class="bg-gray-500/90 text-white text-xs px-2 md:px-3 py-1 rounded-full flex items-center">
                            <span>0%</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Alert -->
        @if($percentageChange > 0)
            <div class="mx-3 md:mx-4 mt-3 md:mt-4 bg-red-50 border-l-4 border-red-500 p-3 md:p-4 rounded shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500"></i>
                    </div>
                    <div class="ml-2 md:ml-3">
                        <p class="text-xs md:text-sm text-red-700">
                            Pengeluaran hari ini {{ $percentageChange }}% lebih tinggi dari kemarin. Coba kurangi pengeluaran non-esensial.
                        </p>
                    </div>
                </div>
            </div>
        @elseif($percentageChange < 0)
            <div class="mx-3 md:mx-4 mt-3 md:mt-4 bg-green-50 border-l-4 border-green-500 p-3 md:p-4 rounded shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-2 md:ml-3">
                        <p class="text-xs md:text-sm text-green-700">
                            Bagus! Pengeluaran hari ini {{ abs($percentageChange) }}% lebih rendah dari kemarin.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Chart Section -->
        <div class="p-3 md:p-4">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-base md:text-lg font-semibold navy-text">Analisis Pengeluaran</h2>
                <div class="flex border rounded-lg overflow-hidden text-xs md:text-sm">
                    <button class="chart-period-btn bg-white py-1 px-2 md:px-3 navy-blue text-white"
                        data-period="week">Minggu</button>
                    <button class="chart-period-btn bg-white py-1 px-2 md:px-3 text-gray-600"
                        data-period="month">Bulan</button>
                    <button class="chart-period-btn bg-white py-1 px-2 md:px-3 text-gray-600"
                        data-period="year">Tahun</button>
                </div>
            </div>

            <div class="bg-white p-3 md:p-4 rounded-xl shadow-sm">
                <div class="relative" style="height: 200px;">
                    <canvas id="expenseChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Top Categories -->
        <div class="p-3 md:p-4">
            <h2 class="text-base md:text-lg font-semibold mb-2 md:mb-3 navy-text">Kategori Teratas</h2>

            <div class="space-y-2 md:space-y-3">
                @forelse($topCategories as $index => $category)
                    @php
                        // Define color classes for icons based on category color or use defaults
                        $colorClasses = [
                            'blue' => 'bg-blue-100 text-blue-500',
                            'purple' => 'bg-purple-100 text-purple-500',
                            'green' => 'bg-green-100 text-green-500',
                            'red' => 'bg-red-100 text-red-500',
                            'yellow' => 'bg-yellow-100 text-yellow-500',
                            'indigo' => 'bg-indigo-100 text-indigo-500',
                            'pink' => 'bg-pink-100 text-pink-500',
                        ];
                        $defaultColors = ['blue', 'purple', 'green', 'red', 'yellow'];
                        $colorClass = $colorClasses[$category->color ?? $defaultColors[$index % count($defaultColors)]];
                    @endphp
                    
                    <div class="bg-white p-2 md:p-3 rounded-xl shadow-sm flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center {{ $colorClass }}">
                                <i class="fas fa-{{ $category->icon ?? 'tag' }} text-sm md:text-base"></i>
                            </div>
                            <div class="ml-2 md:ml-3">
                                <div class="text-sm md:text-base font-medium">{{ $category->name }}</div>
                                <div class="text-xs text-gray-500">{{ $category->transaction_count }} transaksi</div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm md:text-base font-semibold">Rp {{ number_format($category->total_amount, 0, ',', '.') }}</div>
                            <div class="text-xs text-gray-500">{{ $category->percentage }}% dari total</div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-3 rounded-xl shadow-sm text-center text-gray-500">
                        Belum ada data kategori
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="p-3 md:p-4">
            <div class="flex justify-between items-center mb-2 md:mb-3">
                <h2 class="text-base md:text-lg font-semibold navy-text">Transaksi Terbaru</h2>
                <a href="#" class="text-xs md:text-sm text-blue-500">Lihat Semua</a>
            </div>

            <div class="space-y-2 md:space-y-3">
                @forelse($recentTransactions as $transaction)
                    @php
                        $colorClasses = [
                            'blue' => 'bg-blue-100 text-blue-500',
                            'purple' => 'bg-purple-100 text-purple-500',
                            'green' => 'bg-green-100 text-green-500',
                            'red' => 'bg-red-100 text-red-500',
                            'yellow' => 'bg-yellow-100 text-yellow-500',
                            'indigo' => 'bg-indigo-100 text-indigo-500',
                            'pink' => 'bg-pink-100 text-pink-500',
                        ];
                        $defaultColor = 'blue';
                        $categoryColor = $transaction->category->color ?? $defaultColor;
                        $colorClass = $colorClasses[$categoryColor] ?? $colorClasses[$defaultColor];
                        
                        // Format date and time for display
                        $transactionDate = \Carbon\Carbon::parse($transaction->date);
                        $today = \Carbon\Carbon::today();
                        $yesterday = \Carbon\Carbon::yesterday();
                        
                        if ($transactionDate->isSameDay($today)) {
                            $dateDisplay = 'Hari ini';
                        } elseif ($transactionDate->isSameDay($yesterday)) {
                            $dateDisplay = 'Kemarin';
                        } else {
                            $dateDisplay = $transactionDate->translatedFormat('j M Y');
                        }
                        
                        $timeDisplay = $transaction->time ? \Carbon\Carbon::parse($transaction->time)->format('H:i') : '';
                    @endphp
                    
                    <div class="bg-white p-2 md:p-3 rounded-xl shadow-sm flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center {{ $colorClass }}">
                                <i class="fas fa-{{ $transaction->category->icon ?? 'tag' }} text-sm md:text-base"></i>
                            </div>
                            <div class="ml-2 md:ml-3">
                                <div class="text-sm md:text-base font-medium">{{ $transaction->description ?? $transaction->category->name }}</div>
                                <div class="text-xs text-gray-500">{{ $dateDisplay }}{{ $timeDisplay ? ', '.$timeDisplay : '' }}</div>
                            </div>
                        </div>
                        <div class="text-sm md:text-base font-semibold text-red-500">-Rp {{ number_format($transaction->amount, 0, ',', '.') }}</div>
                    </div>
                @empty
                    <div class="bg-white p-3 rounded-xl shadow-sm text-center text-gray-500">
                        Belum ada transaksi terbaru
                    </div>
                @endforelse
            </div>
        </div>
        
        <!-- Comparison Section -->
        <div class="p-3 md:p-4">
            <h2 class="text-base md:text-lg font-semibold mb-2 md:mb-3 navy-text">Perbandingan Pengeluaran</h2>

            <!-- Weekly Comparison -->
            <div class="bg-white p-3 md:p-4 rounded-xl shadow-sm mb-3">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-medium text-sm md:text-base">Minggu Ini vs Minggu Lalu</h3>
                    <div class="flex items-center text-xs">
                        <span class="mr-1">Perubahan:</span>
                        @if($weeklyComparison['percentage_change'] !== 0)
                            <span class="font-semibold {{ $weeklyComparison['percentage_change'] > 0 ? 'text-red-500' : 'text-green-500' }} flex items-center">
                                <i class="fas fa-arrow-{{ $weeklyComparison['percentage_change'] > 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $weeklyComparison['percentage_change'] }}%
                            </span>
                        @else
                            <span class="font-semibold text-gray-500">0%</span>
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-blue-50 p-2 rounded-lg">
                        <div class="text-xs text-gray-500">Minggu Ini</div>
                        <div class="font-bold">Rp {{ number_format($weeklyComparison['current']['total'], 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-500">{{ $weeklyComparison['current']['label'] }}</div>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg">
                        <div class="text-xs text-gray-500">Minggu Lalu</div>
                        <div class="font-bold">Rp {{ number_format($weeklyComparison['previous']['total'], 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-500">{{ $weeklyComparison['previous']['label'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Monthly Comparison -->
            <div class="bg-white p-3 md:p-4 rounded-xl shadow-sm mb-3">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-medium text-sm md:text-base">Bulan Ini vs Bulan Lalu</h3>
                    <div class="flex items-center text-xs">
                        <span class="mr-1">Perubahan:</span>
                        @if($monthlyComparison['percentage_change'] !== 0)
                            <span class="font-semibold {{ $monthlyComparison['percentage_change'] > 0 ? 'text-red-500' : 'text-green-500' }} flex items-center">
                                <i class="fas fa-arrow-{{ $monthlyComparison['percentage_change'] > 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $monthlyComparison['percentage_change'] }}%
                            </span>
                        @else
                            <span class="font-semibold text-gray-500">0%</span>
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-blue-50 p-2 rounded-lg">
                        <div class="text-xs text-gray-500">Bulan Ini</div>
                        <div class="font-bold">Rp {{ number_format($monthlyComparison['current']['total'], 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-500">{{ $monthlyComparison['current']['label'] }}</div>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg">
                        <div class="text-xs text-gray-500">Bulan Lalu</div>
                        <div class="font-bold">Rp {{ number_format($monthlyComparison['previous']['total'], 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-500">{{ $monthlyComparison['previous']['label'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Yearly Comparison -->
            <div class="bg-white p-3 md:p-4 rounded-xl shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-medium text-sm md:text-base">Tahun Ini vs Tahun Lalu</h3>
                    <div class="flex items-center text-xs">
                        <span class="mr-1">Perubahan:</span>
                        @if($yearlyComparison['percentage_change'] !== 0)
                            <span class="font-semibold {{ $yearlyComparison['percentage_change'] > 0 ? 'text-red-500' : 'text-green-500' }} flex items-center">
                                <i class="fas fa-arrow-{{ $yearlyComparison['percentage_change'] > 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $yearlyComparison['percentage_change'] }}%
                            </span>
                        @else
                            <span class="font-semibold text-gray-500">0%</span>
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-blue-50 p-2 rounded-lg">
                        <div class="text-xs text-gray-500">Tahun Ini</div>
                        <div class="font-bold">Rp {{ number_format($yearlyComparison['current']['total'], 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-500">{{ $yearlyComparison['current']['label'] }}</div>
                    </div>
                    <div class="bg-gray-50 p-2 rounded-lg">
                        <div class="text-xs text-gray-500">Tahun Lalu</div>
                        <div class="font-bold">Rp {{ number_format($yearlyComparison['previous']['total'], 0, ',', '.') }}</div>
                        <div class="text-xs text-gray-500">{{ $yearlyComparison['previous']['label'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Initialize Chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart data from controller
            const chartData = {
                week: {
                    labels: {!! json_encode($chartData['week']['labels']) !!},
                    data: {!! json_encode($chartData['week']['data']) !!}
                },
                month: {
                    labels: {!! json_encode($chartData['month']['labels']) !!},
                    data: {!! json_encode($chartData['month']['data']) !!}
                },
                year: {
                    labels: {!! json_encode($chartData['year']['labels']) !!},
                    data: {!! json_encode($chartData['year']['data']) !!}
                }
            };

            // Chart config
            const chartConfig = {
                type: 'bar',
                data: {
                    labels: chartData.week.labels,
                    datasets: [{
                        label: 'Pengeluaran',
                        data: chartData.week.data,
                        backgroundColor: '#000080',
                        borderRadius: 5,
                        barThickness: 'flex',
                        maxBarThickness: 20,
                        minBarLength: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return 'Rp ' + context.raw.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000) + 'k';
                                    }
                                    return 'Rp ' + value;
                                }
                            },
                            grid: {
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            };

            // Initialize chart
            const ctx = document.getElementById('expenseChart').getContext('2d');
            const expenseChart = new Chart(ctx, chartConfig);

            // Chart period switcher
            document.querySelectorAll('.chart-period-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    // Update button styles
                    document.querySelectorAll('.chart-period-btn').forEach(b => {
                        b.classList.remove('navy-blue', 'text-white');
                        b.classList.add('bg-white', 'text-gray-600');
                    });
                    this.classList.add('navy-blue', 'text-white');
                    this.classList.remove('bg-white', 'text-gray-600');

                    // Update chart data
                    const period = this.dataset.period;
                    expenseChart.data.labels = chartData[period].labels;
                    expenseChart.data.datasets[0].data = chartData[period].data;

                    // Adjust y-axis format for yearly view
                    if (period === 'year') {
                        expenseChart.options.scales.y.ticks.callback = function (value) {
                            return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                        };
                    } else {
                        expenseChart.options.scales.y.ticks.callback = function (value) {
                            if (value >= 1000000) {
                                return 'Rp ' + (value / 1000000).toFixed(1) + 'jt';
                            } else if (value >= 1000) {
                                return 'Rp ' + (value / 1000) + 'k';
                            }
                            return 'Rp ' + value;
                        };
                    }

                    expenseChart.update();
                });
            });

            // Set initial active period
            document.querySelector('.chart-period-btn[data-period="week"]').click();
        });
    </script>
@endsection