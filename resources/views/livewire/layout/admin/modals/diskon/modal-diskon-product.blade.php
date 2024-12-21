<div>
    <div x-data="{ open: false }">
        <button type="button" @click="$dispatch('modal-diskon-product')"
            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-ungu-dark text-white hover:bg-[#6A189C] focus:outline-none focus:bg-[#6A189C] disabled:opacity-50 disabled:pointer-events-none">
            <i class="fa-solid fa-plus shrink-0 text-base"></i>
            Add diskon
        </button>

        {{-- Modal add diskon --}}
        <div x-show="open" @modal-diskon-product.window="open = true" @close-modal-diskon-product.window="open = false"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-40"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <!-- Modal -->
        <div x-show="open" @modal-diskon-product.window="open = true" @close-modal-diskon-product.window="open = false"
            class="fixed inset-0 z-50 overflow-y-auto" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            <div class="flex min-h-full items-center justify-center p-0 sm:p-4">
                <div
                    class="modal-content relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all w-full mx-auto sm:max-w-lg">
                    <!-- Modal Header -->
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="flex flex-col sm:flex-row sm:items-start">
                            <div class="mt-3 w-full">
                                <h3 class="text-xl font-semibold leading-6 text-gray-900 mb-4 text-center sm:text-left">
                                    {{ $is_edit == true ? 'Edit' : 'Add' }} Discount</h3>

                                <form
                                    wire:submit="{{ $is_edit == true ? 'updateDiskonProduct' : 'createDiskonProduct' }}"
                                    class="space-y-4">
                                    <!-- Total Discount -->
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-gray-700">Name
                                            Discount</label>
                                        <input type="text" wire:model="name"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark px-3 py-2"
                                            required>
                                    </div>

                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-gray-700">Total
                                            Discount</label>
                                        <input type="number" wire:model="jumlah_diskon"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark px-3 py-2"
                                            required>
                                    </div>

                                    <!-- Discount Type -->
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-gray-700">Discount
                                            Type</label>
                                        <select wire:model="type"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark px-3 py-2"
                                            required>
                                            <option value="">Pilih tipe diskon</option>
                                            <option value="fixed">Tetap</option>
                                            <option value="percentage">Persen</option>
                                        </select>
                                    </div>

                                    {{-- Select Product --}}
                                    <div x-data="{ open: false }" class="w-full">
                                        <label class="block text-sm font-medium text-gray-700">Select
                                            Product</label>
                                        <button @click="open = true" type="button"
                                            class="px-4 py-2 bg-ungu-dark hover:bg-ungu-white text-white rounded-lg">
                                            Select Product
                                        </button>
                                        @include('admin.modals.modal-crud-diskon-product')
                                    </div>

                                    <!-- Date Fields Container -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                                        <!-- Start Date -->
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-gray-700">Start
                                                Date</label>
                                            <input type="date" wire:model="start_date"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark px-3 py-2"
                                                required>
                                        </div>

                                        <!-- End Date -->
                                        <div class="w-full">
                                            <label class="block text-sm font-medium text-gray-700">End
                                                Date</label>
                                            <input type="date" wire:model="end_date"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark px-3 py-2"
                                                required>
                                        </div>
                                    </div>

                                    <button type="button" wire:click="resetInput"
                                        class="w-full sm:w-auto inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="w-full sm:w-auto inline-flex justify-center rounded-md bg-ungu-dark px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-ungu-white">
                                        {{ $is_edit == true ? 'Update' : 'Add' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal confirmasi delete diskon -->
    <div x-data="{ open: false }" x-show="open" @modal-confirmasi-diskon-prouduct.window="open = true"
        @close-modal-confirmasi-diskon-prouduct.window="open = false"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
        <div class="relative top-20 mx-auto p-5 border w-[500px] shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
                    <i class="fa-solid fa-exclamation text-blue-600"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">Peringatan: Anda akan menghapus diskon
                    {{ $name }}.</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Aksi ini tidak dapat diulang. Apakah Anda tetap ingin menghapus diskon?
                    </p>
                </div>
                <div class="flex justify-between items-center px-4 py-3 gap-10">
                    <button type="button" wire:click="deleteDiskonProduct"
                        class="px-2 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                        Ya, Hapus
                    </button>
                    <button type="button" wire:click="resetInput"
                        class="px-2 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>