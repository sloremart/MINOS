<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            <div class="absolute top-0 left-0 opacity-100 ">
                <img src="/images/curvas_arriba.png" alt="Top Left Image" class=" w-192 h-60 md:w-192 md:h-60">
            </div>

            <div class="absolute bottom-0 right-0  opacity-100">
                <img src="/images/curvas_abajo.png" alt="Bottom Right Image" class="w-192 h-16 md:w-192 md:h-60">
            </div>
            {{ $slot }}
        </div>

        @livewireScripts
    </body>
</html>
