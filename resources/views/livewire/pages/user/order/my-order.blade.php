<!-- order-list.blade.php -->
<div class="flex-1 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Filter Buttons -->
        <div class="flex flex-wrap gap-2 mb-6">
            <button wire:click="changeFilter('all')"
                class="@if($activeFilter === 'all') bg-ungu-dark text-white @else bg-white text-gray-700 hover:bg-gray-50 @endif px-4 py-2 rounded-lg shadow-sm text-sm font-medium transition-colors duration-200 ease-in-out">
                Semua
            </button>
            @foreach($filters as $key => $label)
            <button wire:click="changeFilter('{{ $key }}')"
                class="@if($activeFilter === $key) bg-ungu-dark text-white @else bg-white text-gray-700 hover:bg-gray-50 @endif px-4 py-2 rounded-lg shadow-sm text-sm font-medium transition-colors duration-200 ease-in-out">
                {{ $label }}
            </button>
            @endforeach
        </div>

        <!-- Orders Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($orders as $order)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                <div class="p-4">
                    <div class="flex items-start space-x-4">
                        <!-- Product Image -->
                        <img src="{{ asset('storage/'. $order->product->cover_image) }}"
                            alt="{{ $order->product->title }}" class="w-24 h-24 object-cover rounded-lg">

                        <!-- Product Info -->
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-medium text-gray-900 truncate">
                                {{ $order->product->title }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                            </p>

                            <!-- Status Badge -->
                            <div class="mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @switch($order->status)
                                                @case('pembayaran')
                                                    bg-yellow-100 text-yellow-800
                                                    @break
                                                @case('diproses')
                                                    bg-blue-100 text-blue-800
                                                    @break
                                                @case('dikirim')
                                                    bg-indigo-100 text-indigo-800
                                                    @break
                                                @case('dibatalkan')
                                                    bg-red-100 text-red-800
                                                    @break
                                                @case('selesai')
                                                    bg-green-100 text-green-800
                                                    @break
                                            @endswitch
                                        ">
                                    {{ $filters[$order->status] }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Button -->
                    <div class="mt-4">
                        <a href="{{ route('detail-pesanan', $order) }}"
                            class="block w-full text-center px-4 py-2 border border-ungu-dark text-ungu-dark rounded-lg hover:bg-ungu-dark hover:text-white transition-colors duration-200 text-sm font-medium">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="text-center py-12">
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada pesanan</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada pesanan dengan status ini.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Alpine.js Loading State -->
        <div x-data="{ isLoading: false }" x-on:livewire-loading.window="isLoading = true"
            x-on:livewire-load.window="isLoading = false">
            <div x-show="isLoading" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-ungu-dark"></div>
            </div>
        </div>
    </div>
</div>