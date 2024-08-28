<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            height: 100vh;
            overflow-y: auto;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            transition: transform 0.3s ease;
            width: 250px;
        }

        .sidebar.collapsed {
            transform: translateX(-250px);
        }

        .sidebar .nav-link {
            color: #fff;
        }

        .sidebar .nav-link.active {
            color: #0d6efd;
        }

        .navbar-toggler {
            z-index: 1020;
        }

        .sidebar-toggler {
            display: none;
        }

        .sidebar.collapsed + .sidebar-toggler {
            display: block;
        }

        .sidebar .close-btn {
            display: none;
            position: absolute;
            top: 10px;
            right: 10px;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #fff;
        }

        .sidebar:not(.collapsed) .close-btn {
            display: block;
        }

        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
            }

            .sidebar-toggler {
                display: none;
            }
        }

        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                Admin Dashboard
            </a>
            <button class="navbar-toggler sidebar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <aside id="sidebar" class="sidebar bg-dark text-light">
                <button id="closeSidebar" class="close-btn">&times;</button>
                @include('partials.sidebar')
            </aside>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeSidebarButton = document.getElementById('closeSidebar');
            const sidebar = document.getElementById('sidebar');
            const sidebarToggler = document.querySelector('.sidebar-toggler');

            closeSidebarButton.addEventListener('click', function() {
                sidebar.classList.add('collapsed');
            });

            sidebarToggler.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
            });
        });
    </script>
    @yield('scripts') <!-- For additional scripts -->
</body>
</html>
