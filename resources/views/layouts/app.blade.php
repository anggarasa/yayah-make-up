<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ auth()->id() }}">
    <link rel="shortcut icon" href="/img/logo/logo-aplikasi-ym.svg" type="image/x-icon">

    <title>Yayah Make Up</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Font Awesome Icons --}}
    <script src="https://kit.fontawesome.com/9d4da73c07.js" crossorigin="anonymous"></script>

    @livewireStyles

    <style>
        /* Text shadow untuk meningkatkan keterbacaan teks di atas gambar */
        .text-shadow {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Smooth transition untuk slide */
        .transition {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 500ms;
        }

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

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 15s ease infinite;
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        #notification-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            max-width: 400px;
            width: 100%;
        }

        .notification {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateX(100%);
            opacity: 0;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .notification.show {
            transform: translateX(0);
            opacity: 1;
        }

        .notification-order-selesai {
            background: white;
            border-left-color: #10B981;
            color: #065F46;
        }

        .notification-order-proses {
            background: white;
            border-left-color: #3B82F6;
            color: #1E40AF;
        }

        .notification-order-kirim {
            background: white;
            border-left-color: #6c2bd9;
            color: #5521b5;
        }

        .notification-error {
            background: white;
            border-left-color: #EF4444;
            color: #991B1B;
        }

        .notification-content {
            display: flex;
            align-items: flex-start;
        }

        .notification-icon {
            margin-right: 12px;
            font-size: 20px;
        }

        .notification-text {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .notification-details {
            font-size: 0.875rem;
            opacity: 0.8;
        }

        .notification-close {
            background: transparent;
            border: none;
            color: currentColor;
            opacity: 0.5;
            cursor: pointer;
            padding: 4px;
            transition: opacity 0.2s;
        }

        .notification-close:hover {
            opacity: 1;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-poppins antialiased">
    <div class="min-h-screen bg-gray-100">
        <livewire:layout.user.user-navbar />
        <div id="notification-container"></div>
        <main class="pt-20 lg:pt-32">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white mt-12">
            <div class="container mx-auto px-4 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-xl font-bold mb-4">ShopKu</h3>
                        <p class="text-gray-400">Tempat belanja online terpercaya dengan jutaan produk dan promo menarik
                        </p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Layanan</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white">Cara Belanja</a></li>
                            <li><a href="#" class="hover:text-white">Pembayaran</a></li>
                            <li><a href="#" class="hover:text-white">Pengiriman</a></li>
                            <li><a href="#" class="hover:text-white">Pengembalian</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Tentang Kami</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="#" class="hover:text-white">Tentang ShopKu</a></li>
                            <li><a href="#" class="hover:text-white">Karir</a></li>
                            <li><a href="#" class="hover:text-white">Blog</a></li>
                            <li><a href="#" class="hover:text-white">Kebijakan Privasi</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-4">Ikuti Kami</h3>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white text-2xl">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white text-2xl">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white text-2xl">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white text-2xl">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700">
                <div class="container mx-auto px-4 py-6">
                    <p class="text-center text-gray-400">&copy; 2024 ShopKu. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts

    {{-- Ion Icons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const userId = @json(auth()->id());
            window.Echo.private(`pop-up_user.${userId}`)
                .listen('.new-notification', (data) => {
                createNotification(data.message, data.type, data.data);
            });

            function createNotification(message, type = null, data = null) {
                const container = document.getElementById('notification-container');
                const notificationEl = document.createElement('div');
                
                let iconClass = '';
                let notificationClass = 'notification animate-slide-in ';
                
                switch(type) {
                    case 'update_status_order':
                        if (data.status === 'diproses') {
                            notificationClass += 'notification-order-proses';
                            iconClass = 'fas fa-spinner';
                        } else if (data.status === 'dikirim') {
                            notificationClass += 'notification-order-kirim';
                            iconClass = 'fas fa-truck';
                        } else if (data.status === 'selesai') {
                            notificationClass += 'notification-order-selesai';
                            iconClass = 'fas fa-check';
                        }
                        break;
                    default:
                        notificationClass += 'notification-error';
                        iconClass = 'fa-solid fa-circle-exclamation';
                }

                notificationEl.className = notificationClass;
                notificationEl.innerHTML = `
                    <div class="notification-content">
                        <i class="${iconClass} notification-icon"></i>
                        <div class="notification-text">
                            <div class="notification-title">${message}</div>
                            ${data ? `
                                <div class="notification-details">
                                    ${data.order_id ? `Order ID: ${data.order_id}` : ''}
                                    ${data.product_name ? `<br>Product: ${data.product_name}` : ''}
                                    ${data.total_harga ? `<br>Total: Rp ${data.total_harga.toLocaleString()}` : ''}
                                </div>
                            ` : ''}
                        </div>
                        <button class="notification-close">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                `;

                const closeButton = notificationEl.querySelector('.notification-close');
                closeButton.addEventListener('click', () => {
                    notificationEl.style.transform = 'translateX(100%)';
                    notificationEl.style.opacity = '0';
                    setTimeout(() => {
                        notificationEl.remove();
                    }, 300);
                });

                container.appendChild(notificationEl);
                
                // Trigger reflow to ensure animation plays
                notificationEl.offsetHeight;
                notificationEl.classList.add('show');

                setTimeout(() => {
                    notificationEl.style.transform = 'translateX(100%)';
                    notificationEl.style.opacity = '0';
                    setTimeout(() => {
                        notificationEl.remove();
                    }, 300);
                }, 5000);
            }
        });
    </script>
</body>

</html>