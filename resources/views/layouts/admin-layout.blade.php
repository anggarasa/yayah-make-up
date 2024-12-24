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

    {{-- Quill Editor --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    {{-- Css Custom --}}
    <style>
        .modal-backdrop {
            backdrop-filter: blur(5px);
        }

        .color-preview {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 8px;
            border-radius: 4px;
            vertical-align: middle;
        }

        @keyframes progress {
            from {
                width: 100%
            }

            to {
                width: 0%
            }
        }

        .notification-progress {
            animation: progress 3s linear forwards;
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

        /* Hide scrollbar for Chrome, Safari and Opera */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .scrollbar-hide {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .description-transition {
            transition: max-height 0.3s ease-out;
            overflow: hidden;
        }

        @media (max-width: 640px) {
            .modal-content {
                margin: 0.5rem;
                max-height: calc(100vh - 2rem);
                overflow-y: auto;
            }
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

        .notification-order-created {
            background: white;
            border-left-color: #10B981;
            color: #065F46;
        }

        .notification-payment-success {
            background: white;
            border-left-color: #3B82F6;
            color: #1E40AF;
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

<body>
    <div id="notification-container"></div>
    <livewire:layout.admin.notification.popup-notification-admin />
    <div class="antialiased bg-gray-100 font-poppins">
        <livewire:layout.admin.admin-navbar />

        <livewire:layout.admin.sidebar />
        <main class="p-4 md:ml-72 h-auto pt-20">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts

    {{-- Ion Icons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            window.Echo.channel('pop-up_admin')
                .listen('.new-notification', (data) => {
                createNotification(data.message, data.type, data.data);
            });

            function createNotification(message, type = null, data = null) {
                const container = document.getElementById('notification-container');
                const notificationEl = document.createElement('div');
                
                let iconClass = '';
                let notificationClass = 'notification animate-slide-in ';
                
                switch(type) {
                    case 'order_created':
                        notificationClass += 'notification-order-created';
                        iconClass = 'fa-solid fa-cart-shopping';
                        break;
                    case 'payment_success':
                        notificationClass += 'notification-payment-success';
                        iconClass = 'fa-solid fa-circle-check';
                        break;
                    case 'cancel_order':
                        notificationClass += 'notification-error';
                        iconClass = 'fa-solid fa-circle-xmark';
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