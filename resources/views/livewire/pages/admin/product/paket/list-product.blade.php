<div>
    <section class="py-8 antialiased md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <div>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                            <li class="inline-flex items-center">
                                <a href="{{ route('dashboard-admin') }}" wire:navigate
                                    class="inline-flex items-center text-sm font-medium text-ungu-dark hover:underline">
                                    Dashboard
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
                                    <span
                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-ungu-dark md:ms-2">Product</span>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">List-Product</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">List Product
                    </h2>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('create-product') }}" wire:navigate
                        class="px-4 py-2 bg-ungu-dark text-white rounded-md hover:bg-ungu-white focus:outline-none">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Tambah
                    </a>
                </div>
            </div>

            {{-- Tampilan List Product --}}
            @if (count($products) > 0)
            <div class="mb-4 grid gap-4 grid-cols-2 md:mb-8 md:grid-cols-3 xl:grid-cols-5">
                @foreach ($products as $product)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden group relative">
                    <div class="relative">
                        <img src="{{ asset('storage/'. $product->cover_image) }}"
                            class="h-48 w-full object-cover rounded-t-xl" alt="{{ $product->title }}" />

                        <!-- Dropdown Menu untuk Desktop -->
                        <div
                            class="hidden md:block absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open"
                                    class="bg-gray-200 rounded-full p-1 hover:bg-gray-300 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    </svg>
                                </button>

                                <div x-show="open" @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 scale-90"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-90"
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50 border">
                                    <a href="{{ route('update-product', $product->id) }}" wire:navigate
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </a>
                                    <a href="{{ route('delete-product', $product->id) }}" wire:navigate
                                        class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-100">
                                        <i class="fas fa-trash mr-2"></i>Hapus
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol Edit dan Hapus untuk Tablet dan Mobile -->
                        <div class="lg:hidden absolute top-2 right-2 flex space-x-2">
                            <a href="{{ route('update-product', $product->id) }}" wire:navigate
                                class="bg-blue-500 text-white px-2 py-1 rounded-full hover:bg-blue-600">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('delete-product', $product->id) }}" wire:navigate
                                class="bg-red-500 text-white px-2 py-1 rounded-full hover:bg-red-600">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>

                        <!-- Existing Discount Logic -->
                        @if ($product->diskonProducts->isNotEmpty())
                        @php
                        $diskon = $product->diskonProducts->first();
                        @endphp

                        @if ($diskon->is_active)
                        @if ($diskon->type === 'fixed')
                        @php
                        $persentaseDiskon = ($diskon->jumlah_diskon / $product->harga) * 100;
                        @endphp
                        <div class="absolute top-2 left-2 bg-ungu-dark text-white px-2 py-1 rounded-lg text-sm">
                            -{{ number_format($persentaseDiskon, 0, ',', '.') }}%
                        </div>
                        @elseif ($diskon->type === 'percentage')
                        <div class="absolute top-2 left-2 bg-ungu-dark text-white px-2 py-1 rounded-lg text-sm">
                            -{{ number_format($diskon->jumlah_diskon, 0, ',', '.') }}%
                        </div>
                        @endif
                        @endif
                        @endif
                    </div>

                    <div class="p-4">
                        <a href="{{ route('show-product', $product->id) }}"
                            class="font-semibold mb-2 hover:underline">{{
                            Str::limit($product->title, 20, '...') }}</a>
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
                </div>
                @endforeach
            </div>
            @else
            <div class="flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-6xl font-bold font-poppins text-red-500 mb-4">Product Kosong</h1>
                    <p class="text-gray-600 mb-6">Maaf, tidak ada produk yang tersedia saat ini.</p>
                    <a href="{{ route('create-product') }}" wire:navigate
                        class="text-blue-500 hover:text-blue-700 font-semibold">Tambah Product Sekarang</a>
                </div>
            </div>
            @endif
            {{-- Tampilan List Product --}}

            <div class="w-full text-center mt-6">
                @if ($products->count() < $totalData) <button type="button" wire:click="loadMore"
                    class="rounded-lg border border-ungu-white bg-ungu-dark px-5 py-2.5 text-sm font-medium text-white hover:bg-ungu-white focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100">
                    Show more
                    </button>
                    @endif
            </div>
        </div>
    </section>
</div>