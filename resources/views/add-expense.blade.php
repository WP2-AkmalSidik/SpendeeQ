@extends('layouts.app')

@section('title', 'Tambah Pengeluaran')

@section('header-action')
    <a href="{{ route('expenses.index') }}" class="text-white">
        <i class="fa-solid fa-list text-lg"></i>
    </a>
@endsection

@section('content')
    <div class="page-content block" id="page-expense">
        <!-- Header -->
        <div class="bg-blue-900 text-white px-4 py-3 rounded-b-2xl shadow-md relative">
            <div class="flex items-center justify-between">
                <a href="{{ url()->previous() }}" class="text-white text-lg">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-base font-semibold text-center flex-grow">Tambah Pengeluaran</h1>
                <div class="w-8"></div> <!-- Spacer untuk seimbang -->
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow mx-4 mt-6">
            <div class="p-5">
                <form action="{{ route('expenses.store') }}" method="POST">
                    @csrf

                    <!-- Amount Input -->
                    <div class="mb-5">
                        <label class="text-sm text-gray-600 mb-1 block">Jumlah Pengeluaran</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-gray-500">Rp</span>
                            </div>
                            <input type="number" name="amount"
                                class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="0" value="{{ old('amount') }}" required>
                        </div>
                        @error('amount')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Selection -->
                    <div class="mb-5">
                        <label class="text-sm text-gray-600 mb-2 block">Pilih Kategori</label>
                        <div class="grid grid-cols-4 gap-3 mb-3">
                            @foreach ($categories as $category)
                                <label
                                    class="category-option flex flex-col items-center border border-gray-200 rounded-lg py-3 px-2 cursor-pointer hover:bg-blue-50">
                                    <input type="radio" name="category_id" value="{{ $category->id }}" class="hidden"
                                        {{ old('category_id') == $category->id ? 'checked' : '' }}>
                                    <div
                                        class="w-10 h-10 rounded-full bg-{{ $category->color }}-100 flex items-center justify-center text-{{ $category->color }}-500 mb-1">
                                        <i class="fas fa-{{ $category->icon }}"></i>
                                    </div>
                                    <span
                                        class="text-xs text-center overflow-hidden overflow-ellipsis whitespace-nowrap w-full">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('category_id')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date and Time -->
                    @php
                        date_default_timezone_set('Asia/Jakarta');
                    @endphp

                    <div class="grid grid-cols-2 gap-3 mb-5">
                        <div>
                            <label class="text-sm text-gray-600 mb-1 block">Tanggal</label>
                            <input type="date" name="date"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-sm text-gray-600 mb-1 block">Waktu</label>
                            <input type="time" name="time"
                                class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                value="{{ old('time', date('H:i')) }}">
                            @error('time')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <!-- Description -->
                    <div class="mb-6">
                        <label class="text-sm text-gray-600 mb-1 block">Deskripsi (Opsional)</label>
                        <textarea name="description" rows="3"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Tambahkan keterangan pengeluaran...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex gap-3">
                        <button type="submit"
                            class="flex-1 bg-blue-600 text-white font-medium py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Simpan
                        </button>
                        <a href="{{ route('expenses.index') }}"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-4 rounded-lg transition-colors text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category selection highlighting
            const categoryOptions = document.querySelectorAll('.category-option');

            categoryOptions.forEach(option => {
                const radio = option.querySelector('input[type="radio"]');

                // Set initial selection state
                if (radio.checked) {
                    option.classList.add('border-blue-500', 'bg-blue-50');
                }

                option.addEventListener('click', function() {
                    // Reset all
                    categoryOptions.forEach(opt => {
                        opt.classList.remove('border-blue-500', 'bg-blue-50');
                        opt.querySelector('input[type="radio"]').checked = false;
                    });

                    // Select this one
                    option.classList.add('border-blue-500', 'bg-blue-50');
                    radio.checked = true;
                });
            });
        });
    </script>
@endsection
