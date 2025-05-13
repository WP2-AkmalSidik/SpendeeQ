<!-- layouts/auth.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpendeeQ - Aplikasi Pengelola Keuangan</title>
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')


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

        /* Focus States & Animations */
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

        /* Custom Form Elements */
        input[type="checkbox"] {
            border-radius: 4px;
            cursor: pointer;
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .auth-container {
                padding: 1.5rem;
            }
        }

        /* Animation for tabs */
        .tab-active {
            transition: background-color 0.3s ease;
        }

        /* Gradient background for header */
        .header-gradient {
            background: linear-gradient(135deg, #000080 0%, #00008B 100%);
        }
    </style>
</head>

<body class="antialiased">
    @yield('content')

    <!-- App Scripts -->
    <script>
        // Add smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add animation on page load
        document.addEventListener('DOMContentLoaded', function () {
            const formContainer = document.querySelector('.bg-white');
            if (formContainer) {
                formContainer.classList.add('animate-fade-in');
            }
        });
    </script>
</body>

</html>
