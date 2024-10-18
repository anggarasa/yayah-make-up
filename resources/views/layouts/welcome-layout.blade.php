<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/logo/logo-aplikasi-ym.svg" type="image/x-icon">

    <title>Yayah Make Up</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <script src="https://kit.fontawesome.com/9d4da73c07.js" crossorigin="anonymous"></script>

    {{-- Aos Css --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- Css Custom --}}
    <link rel="stylesheet" href="/css/welcome-layout.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-poppins bg-gray-100 text-gray-900 antialiased">

    {{ $slot }}


    @livewireScripts

    {{-- Carousel js --}}
    <script src="/js/carousel-welcome.js"></script>

    {{-- Aos Js --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>