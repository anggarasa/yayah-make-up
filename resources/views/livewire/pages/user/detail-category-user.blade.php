<div>
    {{-- Kategory product Start --}}
    <div class="flex flex-col items-center pt-20 pb-4 bg-white">
        <h2 class="text-2xl font-bold mb-4">Paket Wedding</h2>
        <div class="flex flex-wrap justify-center items-baseline space-x-4 space-y-4">
            <div class="flex flex-col items-center w-24">
                <div class="w-16 h-16 flex justify-center items-center bg-white border rounded-lg">
                    <img alt="Paket Akad" height="40" src="/img/logo/akad.png" width="40" />
                </div>
                <span class="text-sm mt-2 text-center">
                    Paket Akad
                </span>
            </div>
            <div class="flex flex-col items-center w-24">
                <div class="w-16 h-16 flex justify-center items-center bg-white border rounded-lg">
                    <img alt="Paket Melati" height="40" src="/img/logo/melati.png" width="40" />
                </div>
                <span class="text-sm mt-2 text-center">
                    Paket Melati
                </span>
            </div>
            <div class="flex flex-col items-center w-24">
                <div class="w-16 h-16 flex justify-center items-center bg-white border rounded-lg">
                    <img alt="Paket Mawar" height="40" src="/img/logo/mawar.png" width="40" />
                </div>
                <span class="text-sm mt-2 text-center">
                    Paket Mawar
                </span>
            </div>
            <div class="flex flex-col items-center w-24">
                <div class="w-16 h-16 flex justify-center items-center bg-white border rounded-lg">
                    <img alt="Paket Teratai" height="40" src="/img/logo/teratai.png" width="40" />
                </div>
                <span class="text-sm mt-2 text-center">
                    Paket Teratai
                </span>
            </div>
            <div class="flex flex-col items-center w-24">
                <div class="w-16 h-16 flex justify-center items-center bg-white border rounded-lg">
                    <img alt="Paket Tulip" height="40" src="/img/logo/tulip.png" width="40" />
                </div>
                <span class="text-sm mt-2 text-center">
                    Paket Tulip
                </span>
            </div>
            <div class="flex flex-col items-center w-24">
                <div class="w-16 h-16 flex justify-center items-center bg-white border rounded-lg">
                    <img alt="Paket Silver" height="40" src="/img/logo/silver.png" width="40" />
                </div>
                <span class="text-sm mt-2 text-center">
                    Paket Silver
                </span>
            </div>
            <div class="flex flex-col items-center w-24">
                <div class="w-16 h-16 flex justify-center items-center bg-white border rounded-lg">
                    <img alt="Paket Gold" height="40" src="/img/logo/gold.png" width="40" />
                </div>
                <span class="text-sm mt-2 text-center">
                    Paket Gold
                </span>
            </div>
            <div class="flex flex-col items-center w-24">
                <div class="w-16 h-16 flex justify-center items-center bg-white border rounded-lg">
                    <img alt="Paket Jasa Make Up & Kostum" height="40" src="/img/logo/jasa-make-up.png" width="40" />
                </div>
                <span class="text-sm mt-2 text-center">
                    Paket Jasa<br>Make Up<br>& Kostum
                </span>
            </div>
            <div class="flex flex-col items-center w-24">
                <div class="w-16 h-16 flex justify-center items-center bg-white border rounded-lg">
                    <img alt="Daftar Harga Custom (Request)" height="40" src="/img/logo/custom.png" width="40" />
                </div>
                <span class="text-sm mt-2 text-center">
                    Daftar Harga<br>Custom<br>(Request)
                </span>
            </div>
        </div>
    </div>
    {{-- Kategory product End --}}

    {{-- Product list Start --}}
    <div class="mx-auto max-w-screen-xl my-10 px-4 2xl:px-0">
        <div class="bg-white border-b-4 pt-5 mb-5 border-ungu-dark">
            <h2 class="text-center text-xl font-bold text-ungu-dark mb-4">
                SEMUA PAKET WEDDING
            </h2>
        </div>
        <div wire:poll class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($productCategory as $product)
            <a href="{{ route('detail-product-user', $product->id) }}" wire:navigate
                class="rounded-lg border border-gray-200 bg-white shadow-sm hover:border-ungu-dark">
                <div class="w-full h-56 overflow-hidden">
                    <img class="w-full h-full object-cover rounded-t-lg"
                        src="{{ asset('storage/'. $product->cover_image) }}" alt="{{ $product->title }}" />
                    <img class="w-full h-full object-cover hidden dark:block"
                        src="{{ asset('storage/'. $product->cover_image) }}" alt="{{ $product->title }}" />
                </div>
                <div class="p-6">
                    <div class="mb-4 flex items-center justify-between gap-4">
                        <span
                            class="me-2 rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                            Up to 35% off
                        </span>

                        <div class="flex items-center justify-end gap-1">
                            <button type="button" data-tooltip-target="tooltip-quick-look"
                                class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Quick look</span>
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                    <path stroke="currentColor" stroke-width="2"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                            <div id="tooltip-quick-look" role="tooltip"
                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                                data-popper-placement="top">
                                Quick look
                                <div class="tooltip-arrow" data-popper-arrow=""></div>
                            </div>

                            <button type="button" data-tooltip-target="tooltip-add-to-favorites"
                                class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <span class="sr-only">Add to Favorites</span>
                                <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" />
                                </svg>
                            </button>
                            <div id="tooltip-add-to-favorites" role="tooltip"
                                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                                data-popper-placement="top">
                                Add to favorites
                                <div class="tooltip-arrow" data-popper-arrow=""></div>
                            </div>
                        </div>
                    </div>

                    <p class="text-lg font-semibold leading-tight text-gray-900">
                        {{ $product->title }}
                    </p>

                    <div class="mt-2 flex items-center gap-2">
                        <div class="flex items-center">
                            <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                            </svg>
                            <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                            </svg>
                            <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                            </svg>
                            <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                            </svg>
                            <svg class="h-4 w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                            </svg>
                        </div>

                        <p class="text-sm font-medium text-gray-900 dark:text-white">5.0</p>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">(455)</p>
                    </div>

                    <ul class="mt-2 flex items-center gap-4">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                            </svg>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fast Delivery</p>
                        </li>

                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="M8 7V6c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1h-1M3 18v-7c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                            </svg>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Best Price</p>
                        </li>
                    </ul>

                    <div class="mt-4 flex items-center justify-between gap-4">
                        <p class="text-2xl font-extrabold leading-tight text-gray-900 dark:text-white">{{
                            $product->formatted_harga }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="w-full text-center">
            <button type="button"
                class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Show
                more</button>
        </div>
    </div>
    {{-- Product list End --}}
</div>