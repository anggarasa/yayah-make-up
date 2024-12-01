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

    @livewireStyles
</head>

<body class="font-poppins antialiased bg-gray-100">
    <livewire:layout.user.user-navbar-profile />
    <div id="notification-container"></div>
    <div class="flex flex-col md:flex-row min-h-screen">
        @include('user.sidebar-profile-user')
        {{ $slot }}
    </div>

    @livewireScripts

    {{-- Ion Icons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

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