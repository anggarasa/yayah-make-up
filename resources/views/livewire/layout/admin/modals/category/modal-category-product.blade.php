<div wire:ignore>
    <!-- Button to trigger modal -->
    <button @click="$dispatch('category-product-modal')"
        class="px-4 py-2 bg-ungu-dark text-white rounded-md hover:bg-ungu-white focus:outline-none">
        <i class="fa-solid fa-plus mr-2"></i>
        Tambah
    </button>

    <!-- Modal Component -->
    <div x-data="{ open: false }" x-show="open" @category-product-modal.window="open = true"
        @close-category-product-modal.window="open = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">

        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">
                Tambah Category
            </h2>

            <form wire:submit.prevent="saveProduct">
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Category Name<span
                            class="text-red-600">*</span></label>
                    <input wire:model="name" type="text" id="name" wire:input="generateSlug"
                        class="shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-ungu-dark focus:ring-ungu-dark"
                        required>
                </div>

                <input type="text" id="slug" wire:model="slug" class="hidden" readonly>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="text-white bg-ungu-dark hover:bg-ungu-white focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Tembah
                    </button>

                    <button wire:click="resetInput" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                        Cencel
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- Modal notif Success --}}
    <div x-data="{ open: false }" x-show="open"
        @notifikasi-success-modal.window="open = true; setTimeout(() => open = false, 3000)"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <i class="fa-solid fa-check text-green-600"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Successs!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Category product baru berhasil ditambahkan!
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button @click="open = false"
                        class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal notif Success --}}



    {{-- Modal notif Error --}}
    <div x-data="{ open: false }" x-show="open" @notifikasi-error-modal.window="open = true"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fa-solid fa-x text-red-600"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Error!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-600">
                        Slug Category sudah ada, silahkan pilih yang lain. Atau Terjadi masalah dalam proses simpan!
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button @click="open = false"
                        class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal notif Error --}}

    {{-- Modal Update --}}
    <div x-data="{ open: false }" x-show="open" @update-category-product-modal.window="open = true"
        @close-update-category-product-modal.window="open = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">

        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">
                Edit Category
            </h2>

            <form wire:submit.prevent="saveProduct">
                <div class="mb-6">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Category Name<span
                            class="text-red-600">*</span></label>
                    <input wire:model="name" type="text" id="name" wire:input="generateSlug"
                        class="shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-ungu-dark focus:ring-ungu-dark"
                        required>
                </div>

                <input type="text" id="slug" wire:model="slug" class="hidden" readonly>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="text-white bg-ungu-dark hover:bg-ungu-white focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Update
                    </button>

                    <button wire:click="resetInput" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                        Cencel
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- Modal Update --}}


    {{-- Modal notif Success Update --}}
    <div x-data="{ open: false }" x-show="open"
        @modal-success-notifikasi.window="open = true; setTimeout(() => open = false, 3000)"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <i class="fa-solid fa-check text-green-600"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Successs!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Category Product berhasil di ubah!
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button @click="open = false"
                        class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal notif Success Update --}}



    <!-- Modal Konfirmasi -->
    <div x-data="{ open: false }" x-show="open" @confirmasi-delete-modal.window="open = true"
        @close-konfirmasi-delete-modal.window="open = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">

        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                    <i class="fa-solid fa-info text-blue-600"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Confirm!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Apakah Anda yakin ingin menghapus Category ini!
                    </p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button type="button" wire:click="deleteProduct"
                    class="text-white bg-ungu-dark hover:bg-ungu-white focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Hapus
                </button>

                <button wire:click="resetInput" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                    Cencel
                </button>
            </div>
        </div>
    </div>
    {{-- Modal konfirmasi delete --}}


    {{-- Modal notif Success Delete --}}
    <div x-data="{ open: false }" x-show="open"
        @modal-success-notifikasi-delete.window="open = true; setTimeout(() => open = false, 3000)"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <i class="fa-solid fa-check text-green-600"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Successs!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Category Product berhasil di hapus!
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button @click="open = false"
                        class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal notif Success Delete --}}
</div>