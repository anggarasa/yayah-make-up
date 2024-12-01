<div class="flex-1 p-8">
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
                <a href="{{ route('detail-pesanan', $notification->data['order_id']) }}" wire:navigate
                    class="flex items-start space-x-4 p-4 border rounded-lg shadow-sm bg-gray-50 hover:bg-ungu-tipis">
                    @if ($notification->data['type_notification'] === 'status_order_diproses')
                    <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                            src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                            alt="Bonnie Green avatar" />
                        <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-blue-700">
                            <i class="fas fa-spinner text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 font-medium">{{ $notification->data['message'] }}</p>
                        <p class="text-gray-800 font-medium">Rp {{
                            number_format($notification->data['total_harga'], 0, ',', '.') }}</p>
                        <p class="text-white bg-blue-500 rounded-full text-center py-1 text-xs w-16">{{
                            $notification->data['status'] }}</p>
                        <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @elseif ($notification->data['type_notification'] === 'status_order_dikirim')
                    <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                            src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                            alt="Bonnie Green avatar" />
                        <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-purple-700">
                            <i class="fas fa-truck text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 font-medium">{{ $notification->data['message'] }}</p>
                        <p class="text-gray-800 font-medium">Rp {{
                            number_format($notification->data['total_harga'], 0, ',', '.') }}</p>
                        <p class="text-white bg-purple-500 text-center py-1 rounded-full text-xs w-16">{{
                            $notification->data['status'] }}</p>
                        <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                    @elseif ($notification->data['type_notification'] === 'status_order_selesai')
                    <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                            src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                            alt="Bonnie Green avatar" />
                        <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-green-700">
                            <i class="fas fa-check text-white text-xs"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-gray-800 font-medium">{{ $notification->data['message'] }}</p>
                        <p class="text-gray-800 font-medium">Rp {{
                            number_format($notification->data['total_harga'], 0, ',', '.') }}</p>
                        <p class="text-white bg-green-500 text-center py-1 rounded-full text-xs w-16">{{
                            $notification->data['status'] }}</p>
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
</div>