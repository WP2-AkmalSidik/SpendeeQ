<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
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
        <!-- Page content will go here -->
        @yield('content')
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <a href="{{ route('dashboard.index') }}" class="nav-item active">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('expense.index') }}" class="nav-item">
            <i class="fa-solid fa-rupiah-sign"></i>
            <span>Pengeluaran</span>
        </a>
        <a href="/category" class="nav-item">
            <i class="fas fa-tags"></i>
            <span>Kategori</span>
        </a>
        <a href="{{ route('profile.index') }}" class="nav-item">
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
</body>

</html>
