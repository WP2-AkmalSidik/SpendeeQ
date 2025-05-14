<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="{{ config('services.fontawesome.kit_url') }}" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>MoneyTracker</title>
    <style>
        body {
            font-family: var(--font-sans);
            background-color: #f8fafc;
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navy-blue {
            background-color: #000080;
        }

        .navy-text {
            color: #000080;
        }

        .main-content {
            flex: 1;
            padding-bottom: 72px;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 72px;
            background-color: white;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
            align-items: center;
            z-index: 1000;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #64748b;
            font-size: 0.75rem;
            padding: 8px 0;
        }

        .nav-item.active {
            color: #000080;
        }

        .nav-item i {
            font-size: 1.25rem;
            margin-bottom: 4px;
        }
    </style>
</head>

<body>
    <div class="main-content pb-20">
        <div id="loader" class="absolute inset-0 bg-white bg-opacity-70 z-50 hidden flex items-center justify-center">
            <div class="flex flex-col items-center">
                <svg class="animate-spin h-10 w-10 text-[#000080]" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
                <p class="mt-3 text-[#000080] font-semibold animate-pulse">Memuat konten...</p>
            </div>
        </div>

        <!-- Page content will go here -->
        @yield('content')
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <a href="{{ route('dashboard.index') }}"
            class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </a>
        <a href="{{ route('expenses.index') }}" class="nav-item {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
            <i class="fa-solid fa-rupiah-sign"></i>
            <span>Pengeluaran</span>
        </a>
        <a href="{{ route('categories.index') }}"
            class="nav-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i>
            <span>Kategori</span>
        </a>
        <a href="{{ route('profile.index') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="fas fa-user"></i>
            <span>Profil</span>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#000080',
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#000080'
                });
            @endif
        });
    </script>
    <script>
        document.querySelectorAll('.bottom-nav a').forEach(link => {
            link.addEventListener('click', function(e) {
                const currentUrl = window.location.href;
                const targetUrl = this.href;

                if (targetUrl !== currentUrl) {
                    document.getElementById('loader').classList.remove('hidden');
                }
            });
        });

        window.addEventListener('pageshow', function() {
            document.getElementById('loader').classList.add('hidden');
        });
    </script>

</body>

</html>
