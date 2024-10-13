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
                            <li>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
                                    <a href="{{ route('list-product') }}" wire:navigate
                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-ungu-dark md:ms-2">Product-List</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Product-Delete</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            {{-- Form Product --}}
            <div class="max-w-3xl mx-auto py-12 px-4 bg-white rounded-lg border border-black">
                <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-800">
                    Delete Product
                </h2>

                @if ($productId)
                <div class="flex justify-center">
                    <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                        <div class="w-full">
                            <a href="#">
                                <img class="w-72 rounded-t-lg h-64 object-cover"
                                    src="{{ asset('storage/'. $cover_image) }}" alt="" />
                            </a>
                        </div>
                        <div class="p-6">
                            <div class="mb-4 flex items-center justify-between gap-4">
                                <span
                                    class="me-2 rounded bg-ungu-tipis px-2.5 py-0.5 text-xs font-medium text-ungu-white">
                                    diskon </span>

                                <div class="flex items-center justify-end gap-1">
                                    <button type="button" data-tooltip-target="tooltip-add-to-favorites"
                                        class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900hite">
                                        <span class="sr-only"> Add to Favorites </span>
                                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" />
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

                            <a href="#" class="text-lg font-semibold leading-tight text-gray-900 hover:underline">
                                {{ $title }}
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
                                {{ $harga }}
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="flex items-center mt-6 justify-between">
                    <x-ungu-button wire:click="deleteProduct">
                        Delete
                    </x-ungu-button>

                    <x-secondary-button wire:click="cencel">
                        {{ __('Cencel') }}
                    </x-secondary-button>
                </div>
            </div>
            {{-- Form Product --}}
        </div>
    </section>

    @include('admin.modals.modal-product-notifikasi')
</div>