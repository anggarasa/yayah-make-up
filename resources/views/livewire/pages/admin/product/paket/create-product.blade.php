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
                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-ungu-dark md:ms-2">Product-list</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
                                    <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">Create-Product</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>


            {{-- Form create product --}}
            <div class="max-w-3xl mx-auto py-12 px-4 bg-white rounded-lg border border-black">
                <h2 class="text-3xl font-extrabold mb-8 text-center text-gray-800">
                    Tambah Product
                </h2>

                <form wire:submit="createProduct">
                    {{-- input judul Product Start --}}
                    <div>
                        <x-input-label for="title">Judul Product<span class="text-red-600">*</span></x-input-label>
                        <x-text-input type="text" wire:model="title" class="mt-1 block w-full" id="title" />
                    </div>
                    {{-- input judul Product End --}}

                    {{-- input harga product Start --}}
                    <div class="mt-8">
                        <x-input-label for="harga">Harga Product<span class="text-red-600">*</span></x-input-label>
                        <x-text-input type="number" wire:model="harga" id="harga" class="block mt-1 w-full" />
                    </div>
                    {{-- input harga product End --}}

                    {{-- input Kategory Product Start --}}
                    <div class="mt-8">
                        <x-input-label for="category_product_id">
                            Kategory Product<span class="text-red-600">*</span>
                        </x-input-label>
                        <x-select-input wire:model="category_product_id" id="category_product_id">
                            <option value="">Pilih Kategory Product</option>
                            @foreach ($categoryProducts as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-select-input>
                    </div>
                    {{-- input Kategory Product End --}}

                    {{-- input coverImage --}}
                    <div class="mt-8" x-data="{ imagePreview: null }">
                        <x-input-label for="cover_image">
                            Pilih Cover Image<span class="text-red-600">*</span>
                        </x-input-label>
                        <div class="relative">
                            <input type="file" id="cover_image" wire:model="cover_image" accept="image/*"
                                @change="imagePreview = URL.createObjectURL($event.target.files[0])" class="hidden">
                            <label for="cover_image"
                                class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-300">
                                <i class="fa-regular fa-image mr-2 text-gray-400 text-2xl"></i>
                                Pilih Cover image
                            </label>
                        </div>

                        <div class="flex items-center gap-5">
                            <div x-show="imagePreview" class="mt-6">
                                <img :src="imagePreview" alt="Preview" class="max-w-44 h-auto rounded-lg shadow-md">
                            </div>
                        </div>
                    </div>
                    {{-- input coverImage --}}

                    {{-- input imageProduct --}}
                    <div class="mt-8" x-data="imagePreview()">
                        <x-input-label for="image_product">
                            Pilih Gambar<span class="text-red-600">*</span>
                        </x-input-label>
                        <div class="relative">
                            <input type="file" id="image_product" wire:model="image_product" accept="image/*" multiple
                                @change="handleFileChange($event)" class="hidden">
                            <label for="image_product"
                                class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-300">
                                <i class="fa-regular fa-image text-2xl mr-2 text-gray-400"></i>
                                Pilih Gambar
                            </label>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <template x-for="image in images" :key="image">
                                <div class="border rounded overflow-hidden">
                                    <img :src="image" class="w-full h-32 object-cover">
                                </div>
                            </template>
                        </div>
                    </div>
                    {{-- input imageProduct --}}

                    {{-- input videoProduct --}}
                    <div class="mt-8" x-data="videoPreview()">
                        <x-input-label for="video_product">
                            Pilih Video (Opsional)
                        </x-input-label>
                        <div class="relative">
                            <input type="file" id="video_product" wire:model="video_product" accept="video/*" multiple
                                @change="handleFileChange($event)" class="hidden">
                            <label for="video_product"
                                class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50 transition duration-300">
                                <i class="fa-solid fa-film text-2xl mr-2 text-gray-400"></i>
                                Pilih Video
                            </label>
                        </div>
                        <div class="grid grid-cols-3 gap-4">
                            <template x-for="video in videos" :key="video">
                                <div class="border rounded overflow-hidden">
                                    <video controls class="w-full h-32 object-cover">
                                        <source :src="video" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </template>
                        </div>
                    </div>
                    {{-- input videoProduct --}}

                    {{-- input Modal Dress --}}
                    <div class="mt-8" x-data="{ open: false }">
                        <x-input-label :value="__('Pilih Baju Akad/Respsi (Opsional)')" />
                        <x-ungu-button @click="open = true">Pilih Baju</x-ungu-button>
                        @include('admin.modals.modal-crud-dress-product')
                    </div>
                    {{-- input Modal Dress --}}

                    {{-- input deskripsi product Start --}}
                    <div class="mt-8" wire:ignore>
                        <x-input-label for="description">
                            Deskripsi Product<span class="text-red-600">*</span>
                        </x-input-label>
                        <div id="description">{!! $description !!}</div>
                    </div>
                    {{-- input deskripsi product End --}}

                    <div class="flex items-center mt-6 justify-between">
                        <x-primary-button>
                            Simpan
                        </x-primary-button>

                        <x-secondary-button wire:click="cencel">
                            {{ __('Cencel') }}
                        </x-secondary-button>
                    </div>
                </form>
            </div>
            {{-- Form create product --}}
        </div>
    </section>

    {{-- modal product --}}
    @include('admin.modals.modal-product-notifikasi')
    {{-- modal product --}}

    {{-- Quill Editor --}}
    @include('admin.js.quill-editor')
    {{-- Quill Editor --}}

    {{-- Product Js --}}
    @include('admin.js.create-product-js')
    {{-- Product Js --}}
</div>