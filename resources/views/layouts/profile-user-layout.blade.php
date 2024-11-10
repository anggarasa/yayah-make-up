<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/img/logo/logo-aplikasi-ym.svg" type="image/x-icon">

    <title>Yayah Make Up</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Font Awesome Icons --}}
    <script src="https://kit.fontawesome.com/9d4da73c07.js" crossorigin="anonymous"></script>

    {{-- css custom --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-poppins antialiased bg-gray-100">
    <livewire:layout.user.user-navbar-profile />
    <div class="flex flex-col md:flex-row min-h-screen">
        @include('user.sidebar-profile-user')
        {{ $slot }}
    </div>

    @livewireScripts

    {{-- Ion Icons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>