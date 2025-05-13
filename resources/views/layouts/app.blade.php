<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/af96158b7b.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            /* Space for bottom nav */
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
        <a href="/" class="nav-item active">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="/add" class="nav-item">
            <i class="fas fa-plus-circle"></i>
            <span>Add</span>
        </a>
        <a href="/category" class="nav-item">
            <i class="fas fa-tags"></i>
            <span>Category</span>
        </a>
        <a href="/profile" class="nav-item">
            <i class="fas fa-user"></i>
            <span>Profile</span>
        </a>
    </div>
</body>

</html>
