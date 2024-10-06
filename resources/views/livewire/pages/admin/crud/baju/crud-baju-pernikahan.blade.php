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
                            <li>
                                <div class="flex items-center">
                                    <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
                                    <a href="{{ route('baju-pernikahan') }}" wire:navigate
                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-ungu-dark md:ms-2">Baju-Pernikahan</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
                                    <span
                                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Baju-Pernikahan-Create</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            {{-- Form Baju Pernikahan --}}
            <div x-data="{ imagePreview: null}" wire:ignore
                class="max-w-3xl mx-auto py-12 px-4 bg-white rounded-lg border border-black">
                <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-800">
                    {{ $dressId ? 'Update' : 'Add' }} Dress
                </h2>

                <form wire:submit="saveDress">
                    <div>
                        <x-input-label for="image_dress" :value="__('Upload Image')" />

                        <div class="relative">
                            <input type="file" id="image_dress" wire:model="image_dress" accept="image/*"
                                @change="imagePreview = URL.createObjectURL($event.target.files[0])" class="hidden">
                            <label for="image_dress"
                                class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-300">
                                <i class="fa-regular fa-image mr-2 text-gray-400 text-2xl"></i>
                                Choose a file
                            </label>
                        </div>

                        <div class="flex items-center gap-5">
                            <div x-show="imagePreview" class="mt-6">
                                @if ($dressId)
                                <span class="text-lg text-black">Gambar Baru</span>
                                @endif
                                <img :src="imagePreview" alt="Preview" class="max-w-44 h-auto rounded-lg shadow-md">
                            </div>

                            <div class="mt-6">
                                @if ($oldImage)
                                <span class="text-lg text-black">Gambar Sebelumnya</span>
                                <img src="{{ asset('storage/file-dress/'. $oldImage) }}" alt="Preview"
                                    class="max-w-44 h-auto rounded-lg shadow-md">
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <x-input-label for="name" :value="__('Nama Baju')" />
                        <x-text-input wire:model="name" class="mt-1 block w-full" id="name" />
                    </div>

                    <div class="mt-8">
                        <x-input-label for="dress_type" :value="__('Kategory Baju')" />
                        <x-select-input wire:model="dress_type" id="dress_type">
                            <option value="">Pilih kategori untuk baju</option>
                            <option value="Akad">Akad</option>
                            <option value="Resepsi">Resepsi</option>
                        </x-select-input>
                    </div>

                    <div class="flex items-center mt-6 justify-between">
                        <x-primary-button>
                            {{ __('Simpan') }}
                        </x-primary-button>

                        <x-secondary-button wire:click="resetInput">
                            {{ __('Cencel') }}
                        </x-secondary-button>
                    </div>
                </form>
            </div>
            {{-- Form Baju Pernikahan --}}
        </div>
    </section>

    {{-- modal Notifikasi --}}
    @include('admin.modals.modal-dress-notifikasi')
    {{-- modal Notifikasi --}}
</div>