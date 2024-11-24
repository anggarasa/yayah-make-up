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

    @livewireStyles

    <style>
        .quill-content ol {
            list-style-type: decimal;
            padding-left: 1.5em;
        }

        .quill-content ol>li {
            display: list-item;
            margin-bottom: 0.5em;
        }

        .quill-content ol>li::before {
            content: none;
        }

        .quill-content .ql-ui {
            display: none;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-poppins antialiased">
    <div class="min-h-screen bg-gray-100">
        <livewire:layout.user.user-navbar />
        <main class="pt-20 lg:pt-32">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts

    {{-- Ion Icons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>