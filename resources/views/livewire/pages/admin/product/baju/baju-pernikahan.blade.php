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
                                    <a href="#"
                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-ungu-dark md:ms-2">Product</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Baju-Pernikahan</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Baju Pernikahan
                    </h2>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('baju-pernikahan-create') }}" wire:navigate
                        class="px-4 py-2 bg-ungu-dark text-white rounded-md hover:bg-ungu-white focus:outline-none">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Tambah
                    </a>
                </div>
            </div>

            <!-- Baju Pernikahan View -->
            <div class="py-12 grid grid-cols-3 gap-4 sm:gap-6 md:gap-8 lg:gap-12">
                <!-- Card -->
                @foreach ($dresses as $baju)
                <div class="group flex flex-col focus:outline-none">
                    <div class="aspect-w-16 aspect-h-12 overflow-hidden bg-gray-100 rounded-2xl">
                        <img class="w-full h-96 group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out object-cover rounded-2xl"
                            src="{{ asset('storage/file-dress/'. $baju->image_dress) }}" alt="{{ $baju->name }}">
                    </div>

                    <div class="pt-4">
                        <h3
                            class="relative inline-block font-medium text-lg text-black before:absolute before:bottom-0.5 before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-ungu-dark before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100">
                            {{ $baju->name }}
                        </h3>

                        <div class="mt-3 flex justify-between items-center gap-2">
                            <a href="{{ route('baju-pernikahan-update', $baju->id) }}" wire:navigate
                                class="px-4 py-2 text-white bg-ungu-dark rounded-lg hover:bg-ungu-white">
                                {{ __('Ubah') }}
                            </a>
                            <button wire:click="confirmDelete({{ $baju->id }})"
                                class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-400">
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End Card -->
            </div>

            <div class="mx-[425px]">
                {{ $dresses->links() }}
            </div>

            {{-- Modal Nodtifikasi Start --}}
            @include('admin.modals.modal-dress-notifikasi')
            {{-- Modal Nodtifikasi End --}}
        </div>
    </section>
</div>