<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts and icons -->
    <script src="{{ asset('build/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('build/assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('build/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/plugins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/css/kaiadmin.min.css') }}">

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <div class="main-panel">
            <!-- Navbar -->
            @include('layouts.navbar')

            <!-- Content -->
            <div class="container pt-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <div>
                        &copy; {{ date('Y') }} - Kaiadmin Theme by <a href="https://themewagon.com/"
                            target="_blank">ThemeWagon</a>
                    </div>
                    <div>
                        Laravel integration by YourTeam
                    </div>
                </div>
            </footer>

        </div>
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('build/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('build/assets/js/kaiadmin.min.js') }}"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        $(document).ready(function() {
            // Toggle sidebar
            $('.toggle-sidebar').click(function() {
                $('.sidebar').toggleClass('active');
                $('.main-panel').toggleClass('active');
            });

            // Toggle sidenav
            $('.sidenav-toggler').click(function() {
                $('.sidebar').toggleClass('sidenav-toggled');
                $('.main-panel').toggleClass('sidenav-toggled');
            });

            // Toggle topbar
            $('.topbar-toggler').click(function() {
                $('.navbar-header').toggleClass('active');
            });

            // Close sidebar when clicking outside
            $(document).click(function(e) {
                if (!$(e.target).closest('.sidebar, .toggle-sidebar, .sidenav-toggler').length) {
                    if ($('.sidebar').hasClass('active')) {
                        $('.sidebar').removeClass('active');
                        $('.main-panel').removeClass('active');
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
