<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Daftar Pesanan</h1>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-6">
            <div class="flex flex-wrap gap-4">
                @foreach(['all' => 'Semua', 'pembayaran' => 'Pembayaran', 'diproses' => 'Diproses', 'dikirim' =>
                'Dikirim', 'selesai' => 'Selesai'] as $status => $label)
                <button wire:click="$set('selectedStatus', '{{ $status }}')"
                    class="{{ $selectedStatus === $status ? 'bg-ungu-dark text-white' : 'bg-gray-100 text-gray-700' }} px-4 py-2 rounded-md transition-colors">
                    {{ $label }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- Orders Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($filteredOrders as $order)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <img src="{{ asset('storage/'. $order->product->cover_image) }}" alt="{{ $order->product->title }}"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-500">{{ $order->created_at->diffForHumans() }}</span>
                        <span class="px-2 py-1 rounded-full text-xs font-medium {{ 
                            $order->status === 'pembayaran' ? 'bg-yellow-100 text-yellow-800' : 
                            ($order->status === 'diproses' ? 'bg-blue-100 text-blue-800' : 
                            ($order->status === 'dikirim' ? 'bg-purple-100 text-purple-800' : 
                            ($order->status === 'selesai' ? 'bg-green-100 text-green-800' : ''))) 
                        }}">
                            {{ ucfirst($filters[$order->status]) }}
                        </span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $order->product->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2">Pembeli: {{ $order->customer_name }}</p>
                    <p class="text-lg font-bold text-ungu-dark mb-4">Rp {{ number_format($order->total_harga, 0, ',',
                        '.') }}</p>
                    <a href="{{ route('order.show-order', $order) }}" wire:navigate
                        class="w-full bg-ungu-dark text-white py-2 px-4 rounded-md hover:bg-[#6A1696] transition-colors">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Tidak ada pesanan ditemukan</p>
            </div>
            @endforelse
        </div>
    </div>
</div>