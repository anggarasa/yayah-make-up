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
            <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($products as $product)
                <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="w-full">
                        <a href="{{ route('show-product', $product->id) }}" wire:navigate>
                            <img class="w-72 rounded-t-lg h-64 object-cover"
                                src="{{ asset('storage/'. $product->cover_image) }}" alt="" />
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="mb-4 flex items-center justify-between gap-4">
                            <span class="me-2 rounded bg-ungu-tipis px-2.5 py-0.5 text-xs font-medium text-ungu-white">
                                diskon </span>

                            <div class="flex items-center justify-end gap-1">
                                <button type="button" data-tooltip-target="tooltip-add-to-favorites"
                                    class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900hite">
                                    <span class="sr-only"> Add to Favorites </span>
                                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" />
                                    </svg>
                                </button>
                                <div id="tooltip-add-to-favorites" role="tooltip"
                                    class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300"
                                    data-popper-placement="top">
                                    Add to favorites
                                    <div class="tooltip-arrow" data-popper-arrow=""></div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('show-product', $product->id) }}" wire:navigate
                            class="text-lg font-semibold leading-tight text-gray-900 hover:underline">
                            {{ $product->title }}
                        </a>

                        <div class="mt-2 flex items-center gap-2">
                            <div class="flex items-center">
                                <i class="fa-solid fa-star text-yellow-400"></i>

                                <i class="fa-solid fa-star text-yellow-400"></i>

                                <i class="fa-solid fa-star text-yellow-400"></i>

                                <i class="fa-solid fa-star text-yellow-400"></i>

                                <i class="fa-regular fa-star text-yellow-400"></i>
                            </div>

                            <p class="text-sm font-medium text-gray-900">4.0</p>
                            <p class="text-sm font-medium text-gray-500">(455)</p>
                        </div>

                        <p class="text-2xl mt-4 font-extrabold leading-tight text-gray-900">
                            {{ $product->formatted_harga }}
                        </p>

                        <div class="flex justify-between items-center mt-5">
                            <a href="{{ route('update-product', $product->id) }}" wire:navigate
                                class="inline-flex items-center rounded-lg bg-ungu-dark px-5 py-2.5 text-sm font-medium text-white hover:bg-ungu-white focus:outline-none focus:ring-4  focus:ring-ungu-tipis">
                                <i class="fa-solid fa-pen-to-square -ms-2 me-2"></i>
                                Ubah
                            </a>

                            <a href="{{ route('delete-product', $product->id) }}" wire:navigate
                                class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-red-400 focus:outline-none focus:ring-4 focus:ring-red-300">
                                <i class="fa-solid fa-trash-can -ms-2 me-2"></i>
                                Hapus
                            </a>
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

            <div class="mx-[425px]">
                {{ $products->links() }}
            </div>
        </div>
    </section>
</div>