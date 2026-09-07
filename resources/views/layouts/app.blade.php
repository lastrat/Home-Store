<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Home Store - Chic Living, votre boutique de mode et décoration haut de gamme">
    <title>@yield('title', 'Home Store - Chic Living')</title>
    <link rel="stylesheet" href="{{ asset('css/modern.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            50: '#fdf8f0',
                            100: '#f9efd9',
                            200: '#f0d9a8',
                            300: '#e0c78a',
                            400: '#d4b370',
                            500: '#c9a96e',
                            600: '#a88b4a',
                            700: '#8b6f3a',
                            800: '#6b5530',
                            900: '#4a3a22',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body class="antialiased">
    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>
</body>
</html>
