<div>
    {{-- Product list Start --}}
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-xl overflow-hidden shadow-lg">
            <div class="relative h-96">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 animate-gradient">
                    <div class="flex items-center justify-center h-full">
                        <div class="text-center text-white">
                            <h1 class="text-4xl font-bold mb-4">Flash Sale! Diskon Hingga 90%</h1>
                            <p class="text-xl mb-6">Jangan lewatkan penawaran spesial hari ini</p>
                            <button
                                class="bg-white text-purple-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                                Belanja Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Product list Start --}}
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Rekomendasi Untukmu</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            <!-- Product Card -->
            @foreach ($products as $product)
            <a href="{{ route('detail-product-user', $product->id) }}" wire:navigate
                class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden">
                <!-- Menambahkan w-64 untuk mengatur lebar tetap -->
                <div class="relative">
                    <img src="{{ asset('storage/'. $product->cover_image) }}"
                        class="h-48 w-full object-cover rounded-t-xl" alt="{{ $product->title }}" />
                    <div class="absolute top-2 left-2 bg-ungu-dark text-white px-2 py-1 rounded-lg text-sm">
                        -50%
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold mb-2 truncate">{{
                        $product->title }}</h3>
                    <div class="flex flex-col mb-2">
                        @if (!empty($product->harga_diskon))
                        <h3 class="text-ungu-dark font-bold text-lg mb-1">
                            {{ number_format($product->harga_diskon, 0, ',', '.') }}
                        </h3>
                        @else
                        <h3 class="text-ungu-dark font-bold text-lg mb-1">
                            {{ $product->formatted_harga }}
                        </h3>
                        @endif

                        @if (!empty($product->harga_diskon))
                        <span class="text-gray-400 line-through text-sm">{{ $product->formatted_harga }}</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-1 text-yellow-400">
                            <i class="fas fa-star"></i>
                            <span class="text-gray-600 text-sm">4.9</span>
                        </div>
                        <span class="text-gray-600 text-sm">Terjual 1.2rb</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="w-full text-center mt-6">
            @if ($products->count() < $totalData) <button type="button" wire:click="loadMore"
                class="rounded-lg border border-ungu-white bg-ungu-dark px-5 py-2.5 text-sm font-medium text-white hover:bg-ungu-white focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">
                Show more
                </button>
                @endif
        </div>
    </div>
    {{-- Product list End --}}
</div>