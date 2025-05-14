<!-- layouts/auth.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpendeeQ - Aplikasi Pengelola Keuangan</title>
    @vite('resources/css/app.css')
    <script src="{{ config('services.fontawesome.kit_url') }}" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f9fafb;
        }

        .navy-blue {
            background-color: #000080;
        }

        .navy-text {
            color: #000080;
        }
        input:focus {
            box-shadow: 0 0 0 2px rgba(0, 0, 128, 0.2);
            transition: all 0.2s ease;
        }

        .btn-transition {
            transition: all 0.3s ease;
        }

        .btn-transition:hover {
            transform: translateY(-1px);
        }
        input[type="checkbox"] {
            border-radius: 4px;
            cursor: pointer;
        }
        @media (max-width: 640px) {
            .auth-container {
                padding: 1.5rem;
            }
        }
        .tab-active {
            transition: background-color 0.3s ease;
        }
        .header-gradient {
            background: linear-gradient(135deg, #000080 0%, #00008B 100%);
        }
    </style>
</head>

<body class="antialiased">
    @yield('content')

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const formContainer = document.querySelector('.bg-white');
            if (formContainer) {
                formContainer.classList.add('animate-fade-in');
            }
        });
    </script>
</body>

</html>
