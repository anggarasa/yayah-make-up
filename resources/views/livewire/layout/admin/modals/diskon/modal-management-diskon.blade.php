<div>
    <div x-data="{ open: false }">
        <button type="button" @click="$dispatch('modal-diskon')"
            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-ungu-dark text-white hover:bg-[#6A189C] focus:outline-none focus:bg-[#6A189C] disabled:opacity-50 disabled:pointer-events-none">
            <i class="fa-solid fa-plus shrink-0 text-base"></i>
            Add diskon
        </button>

        {{-- Modal add diskon --}}
        <div x-show="open" @modal-diskon.window="open = true" @close-modal-diskon.window="open = false"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-40"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <!-- Modal -->
        <div x-show="open" @modal-diskon.window="open = true" @close-modal-diskon.window="open = false"
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
                                    Add Discount</h3>

                                <form wire:submit="createDiskon" class="space-y-4">
                                    <!-- Discount Code -->
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-gray-700">Discount
                                            Code</label>
                                        <input type="text" wire:model="code"
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

                                    <!-- Total Discount -->
                                    <div class="w-full">
                                        <label class="block text-sm font-medium text-gray-700">Total
                                            Discount</label>
                                        <input type="number" wire:model="harga_diskon"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark px-3 py-2"
                                            required>
                                    </div>

                                    <!-- Date Fields Container -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
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

                                    <button type="button" @click="open = false"
                                        class="w-full sm:w-auto inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        Cancel
                                    </button>
                                    <button type="submit"
                                        class="w-full sm:w-auto inline-flex justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                                        Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    {{-- <div
                        class="bg-gray-50 px-4 py-3 flex flex-col-reverse sm:flex-row sm:justify-end gap-2 sm:px-6">
                        <button type="button" @click="open = false"
                            class="w-full sm:w-auto inline-flex justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" wire:click="createDiskon"
                            class="w-full sm:w-auto inline-flex justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                            Add
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    @include('admin.modals.modal-diskon-notifikasi')
</div>