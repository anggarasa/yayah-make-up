<div>
    <div class="p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Notifikasi</h2>

        @if ($notifications->count() > 0)
        @php
        $groupedNotifications = $this->groupNotificationsByDate($notifications);
        @endphp

        @foreach ($groupedNotifications as $date => $group)
        <h3 class="text-lg font-semibold mt-4 mb-2">{{ $date }}</h3>
        <ul class="space-y-4">
            @foreach ($group as $notification)
            <li>
                <a href="{{ route('order.show-order', $notification->data['order_id']) }}" wire:navigate
                    class="flex items-start space-x-4 p-4 border rounded-lg shadow-sm bg-gray-50 hover:bg-ungu-tipis">
                    @if ($notification->data['type_notification'] === 'order_created')
                    <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                            src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                            alt="Bonnie Green avatar" />
                        <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-green-700">
                            <i class="fa-solid fa-cart-shopping text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 font-medium">{{ $notification->data['message'] }}</p>
                        <p class="text-gray-800 font-medium">Rp {{
                            number_format($notification->data['total_harga'], 0, ',', '.') }}</p>
                        <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @elseif ($notification->data['type_notification'] === 'payment_success')
                    <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                            src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                            alt="Bonnie Green avatar" />
                        <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-blue-700">
                            <i class="fa-solid fa-money-bill text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 font-medium">{{ $notification->data['message'] }}</p>
                        <p class="text-gray-800 font-medium">Rp {{
                            number_format($notification->data['total_harga'], 0, ',', '.') }}</p>
                        <div class="flex items-center space-x-2">
                            <p class="text-white bg-green-500 px-2 py-1 rounded-full text-xs">{{
                                $notification->data['status_payment'] }}</p>
                            <span>-</span>
                            <p class="text-gray-500 text-sm">{{ $notification->data['payment_type'] }}</p>
                        </div>
                        <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @elseif ($notification->data['type_notification'] === 'cancel_order')
                    <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                            src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                            alt="Bonnie Green avatar" />
                        <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-red-700">
                            <i class="fa-solid fa-xmark text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 font-medium">{{ $notification->data['message'] }}</p>
                        <p class="text-gray-800 font-medium">Rp {{
                            number_format($notification->data['total_harga'], 0, ',', '.') }}</p>
                        <div class="flex items-center space-x-2">
                            <p class="text-white bg-red-500 px-2 py-1 rounded-full text-xs">{{
                                $notification->data['status'] }}</p>
                            <span>-</span>
                            <p class="text-gray-500 text-sm">{{ $notification->data['payment_type'] }}</p>
                        </div>
                        <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @endif
                </a>
            </li>
            @endforeach
        </ul>
        @endforeach
        @else
        <p class="text-gray-500">Tidak ada notifikasi baru.</p>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi Echo di sini
            window.Echo.channel('notification')
                .listen('.new-notification', (e) => {
                    @this.refreshNotifications();
                });
        });
    </script>
</div>