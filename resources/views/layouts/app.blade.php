<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            <div class="relative z-50">
                @livewire('navigation-menu')
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="relative min-h-screen">
                <!-- Imagen en la esquina superior izquierda -->
                <div class="absolute top-0 left-0 m-4 z-0 opacity-100">
                    <img src="/images/curvas_arriba.png" alt="Top Left Image" class="w-192 h-60 md:w-192 md:h-60">
                </div>

                <!-- Contenido -->
                <div class="relative z-1">
                    {{ $slot }}
                </div>

                <!-- Imagen en la esquina inferior derecha -->
                <div class="absolute bottom-0 right-0 m-4 z-0 opacity-100">
                    <img src="/images/curvas_abajo.png" alt="Bottom Right Image" class="w-192 h-16 md:w-192 md:h-60">
                </div>
            </main>
        </div>

        @stack('modals')
        <script src="{{ asset('js/chart.js') }}"></script>
        <script src="{{ asset('js/canvasjs.min.js') }}"></script>

        @livewireScripts
    </body>
</html>
