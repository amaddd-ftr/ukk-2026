<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    {{-- Tema --}}
    <script>
        (function () {
            var saved = localStorage.getItem('sakuci-theme');
            var theme = saved ||
                (matchMedia('(prefers-color-scheme: dark)').matches
                    ? 'dark'
                    : 'light');

            document.documentElement.setAttribute(
                'data-bs-theme',
                theme
            );
        })();
    </script>

    {{-- Bootstrap --}}
    <link rel="stylesheet"
          href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">

    {{-- CSS utama --}}
    <link rel="stylesheet"
          href="{{ asset('css/app.css') }}">
</head>

<body class="d-flex flex-column min-vh-100 bg-body-tertiary">

    {{-- Sidebar --}}
    @include('partials.navbar')

    {{-- Konten --}}
    <main class="main-content flex-grow-1">

        @include('partials.flash')

        @yield('content')

    </main>

    {{-- Footer --}}
    @include('partials.footer')


    {{-- Bootstrap JS --}}
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Theme --}}
    <script src="{{ asset('js/theme.js') }}"></script>

    @yield('scripts')


    {{-- Sidebar JS --}}
    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebar && sidebarToggle && sidebarOverlay) {

            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            });

            sidebarOverlay.addEventListener('click', function () {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });

        }
    </script>

</body>
</html>