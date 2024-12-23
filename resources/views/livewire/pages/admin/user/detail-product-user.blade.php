<div>
    <div class="container mx-auto p-4">
        <!-- Heading & Filters -->
        <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
            <div>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}" wire:navigate
                                class="inline-flex items-center text-sm font-medium text-ungu-dark hover:underline">
                                <img src="/img/logo/logo-aplikasi-ym.svg" class="w-5 h-5 mr-1" alt=""> Yayah
                                Make Up
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
                                <a href="{{ route('detail-category-user', $product->categoryProduct->slug) }}"
                                    wire:navigate
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-ungu-dark md:ms-2">{{
                                    $product->categoryProduct->name }}</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fa-solid fa-angle-right shrink-0 mx-2 size-4 text-gray-400"></i>
                                <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">product detail</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>


        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-2/5">
                    @if(count($mediaProducts) > 0)
                    <div class="relative">
                        @if($mediaProducts[$currentIndex]->media_type == 'Video')
                        <video class="w-full h-96 rounded-lg shadow-md" controls autoplay>
                            <source src="{{ asset('storage/' . $mediaProducts[$currentIndex]->file_path) }}"
                                type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @else
                        <img src="{{ asset('storage/' . $mediaProducts[$currentIndex]->file_path) }}"
                            class="w-full h-96 object-cover rounded-lg shadow-md" alt="Image {{ $currentIndex + 1 }}">
                        @endif
                        <button wire:click="prev"
                            class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button wire:click="next"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-50 hover:bg-opacity-75 rounded-full p-2 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-4 relative">
                        <div class="overflow-x-scroll scrollbar-hide">
                            <div class="flex space-x-2 pb-2 w-max">
                                @foreach($mediaProducts as $index => $item)
                                <div wire:click="$set('currentIndex', {{ $index }})"
                                    class="w-20 h-16 rounded cursor-pointer transition-all duration-300 ease-in-out {{ $currentIndex === $index ? 'ring-2 ring-ungu-dark opacity-100' : 'opacity-60 hover:opacity-100' }}">
                                    @if($item->media_type == 'Video')
                                    <video class="w-full h-full object-cover rounded">
                                        <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                                    </video>
                                    @else
                                    <img src="{{ asset('storage/' . $item->file_path) }}"
                                        class="w-full h-full object-cover rounded" alt="Thumbnail {{ $index + 1 }}">
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @else
                    <div
                        class="flex flex-col items-center justify-center min-h-[400px] bg-white rounded-lg shadow-sm p-8 m-4">
                        <i class="fas fa-box-open text-6xl text-gray-400 mb-4"></i>
                        <p class="text-xl text-gray-500 font-medium">No mediaProducts found.</p>
                        <p class="text-gray-400 mt-2">Try adding some new media content</p>
                    </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="lg:w-3/5">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h1 class="text-2xl font-bold mb-2">{{ $product->title }}</h1>

                        {{-- Rating Product --}}
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="ml-2 text-gray-600">(4.5/5 - 128 reviews)</span>
                        </div>

                        <div class="text-3xl font-bold text-ungu-dark mb-4">
                            {{-- Pegecekan apakah produk sedang diskon apa tidak --}}
                            @if (!empty($product->harga_diskon))
                            Rp {{ number_format($product->harga_diskon,
                            0, ',', '.') }}
                            @else
                            {{ $product->formatted_harga }}
                            @endif

                            {{-- Total Asli Sebelum Diskon --}}
                            @if (!empty($product->harga_diskon))
                            <span class="text-sm text-gray-500 line-through">Rp {{
                                $product->formatted_harga }}</span>
                            @endif
                        </div>

                        {{-- Baju Akad Selection --}}
                        @if($hasDresses)
                        @if ($product->dresses()->where('dress_type', 'Akad')->exists())
                        <div class="mb-6">
                            <h2 class="font-semibold mb-2">Baju Akad</h2>
                            <div class="flex gap-2">
                                @foreach($product->dresses()->where('dress_type', 'Akad')->get() as $akad)
                                <div :class="{ 'border-ungu-dark bg-purple-50': {{ $selectedAkadDress }} === {{ $akad->id }} }"
                                    wire:click="selectAkadDress({{ $akad->id }})"
                                    class="cursor-pointer border rounded-md p-2 flex flex-col items-center">
                                    <img src="{{ asset('storage/file-dress/'. $akad->image_dress) }}"
                                        alt="{{ $akad->name }}" class="w-20 h-20 object-cover mb-2">
                                    <span>{{ $akad->name }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Baju Resepsi Section -->
                        @if ($product->dresses()->where('dress_type', 'Resepsi')->exists())
                        <div class="mb-6">
                            <h2 class="font-semibold mb-2">Baju Resepsi (Pilih 2)</h2>
                            <div class="flex gap-2">
                                @foreach($product->dresses()->where('dress_type', 'Resepsi')->get() as $resepsi)
                                <div class="cursor-pointer border rounded-md p-2 flex flex-col items-center" :class=" { 'border-ungu-dark bg-purple-50' : @js(in_array($resepsi->id,
                                    $selectedReceptionDresses)) }"
                                    wire:click="toggleReceptionDress({{ $resepsi->id }})">
                                    <img src="{{ asset('storage/file-dress/'. $resepsi->image_dress) }}"
                                        alt="{{ $resepsi->name }}" class="w-20 h-20 object-cover mb-2">
                                    <span>{{ $resepsi->name }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @endif

                        {{-- Button --}}
                        <div class="flex gap-4">
                            <button
                                class="flex-1 bg-transparent border border-ungu-dark text-ungu-dark py-3 rounded-lg hover:bg-gray-100 transition">
                                Add to Cart
                            </button>
                            <button wire:click="checkout"
                                class="flex-1 bg-ungu-dark text-white py-3 rounded-lg hover:bg-ungu-white transition">
                                Rent Now
                            </button>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div x-data="{ expanded: false }" class="bg-white rounded-lg shadow-lg p-6 mt-6">
                        <h2 class="text-xl font-bold mb-4">Product Description</h2>

                        <div class="quill-content">
                            @if(strlen($product->description) > $descriptionLimit)
                            <div x-show="!expanded">
                                {!! Str::limit($product->description, $descriptionLimit, '') !!}
                                <span class="text-gray-400">...</span>
                            </div>
                            <div x-show="expanded" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0">
                                {!! $product->description !!}
                            </div>
                            <button @click="expanded = !expanded"
                                class="mt-2 text-[#7A1CAC] hover:text-[#6A189C] text-sm font-medium focus:outline-none">
                                <span x-text="expanded ? 'Lihat lebih sedikit' : 'Lihat lebih banyak'"></span>
                            </button>
                            @else
                            {!! $product->description !!}
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- Penilaian Produk dan Rating -->
        <div class="mt-4 bg-white p-4 rounded shadow md:hidden">
            <div class="text-lg font-bold mb-2">
                Penilaian Produk
            </div>
            <div class="flex items-center">
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <svg class="w-4 h-4 text-gray-300 me-1 dark:text-gray-500" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                    <path
                        d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                </svg>
                <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">4.95</p>
                <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">out of</p>
                <p class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400">5</p>
            </div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">1,745 global ratings</p>
            <div class="flex items-center mt-4">
                <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">5 star</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: 70%"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">70%</span>
            </div>
            <div class="flex items-center mt-4">
                <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">4 star</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: 17%"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">17%</span>
            </div>
            <div class="flex items-center mt-4">
                <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">3 star</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: 8%"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">8%</span>
            </div>
            <div class="flex items-center mt-4">
                <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">2 star</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: 4%"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">4%</span>
            </div>
            <div class="flex items-center mt-4">
                <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-500 hover:underline">1 star</a>
                <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-300 rounded" style="width: 1%"></div>
                </div>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">1%</span>
            </div>
        </div>


        <div class="mt-4 bg-white p-4 rounded shadow">
            <div class="text-lg font-bold mb-2">
                Komentar :
            </div>
            <div class="mt-4">
                <div class="flex items-start space-x-4">
                    <img alt="User avatar" class="w-12 h-12 rounded-full" height="50"
                        src="https://oaidalleapiprodscus.blob.core.windows.net/private/org-RcpoXHkzChYnDbFAyeQ8tamr/user-ehrvabJ3DufsCu8YJ7PqY5gl/img-JzuvQ4qbTt7VaDwzCC814DCV.png?st=2024-10-01T01%3A46%3A22Z&amp;se=2024-10-01T03%3A46%3A22Z&amp;sp=r&amp;sv=2024-08-04&amp;sr=b&amp;rscd=inline&amp;rsct=image/png&amp;skoid=d505667d-d6c1-4a0a-bac7-5c84a87759f8&amp;sktid=a48cca56-e6da-484e-a814-9c849652bcb3&amp;skt=2024-10-01T01%3A08%3A29Z&amp;ske=2024-10-02T01%3A08%3A29Z&amp;sks=b&amp;skv=2024-08-04&amp;sig=RfZ69hs5Pi5%2Bk06jhJ8%2B6sHCs7CrHHHI6JKEppFYxHM%3D"
                        width="50" />
                    <div>
                        <div class="flex items-center">
                            <div class="text-yellow-500">
                                <i class="fas fa-star">
                                </i>
                            </div>
                            <div class="text-gray-500 ml-2">
                                2024-03-02 18:24 | Varian: Mocca,32
                            </div>
                        </div>
                        <div class="mt-2">
                            Tampilan: keren sangat modis sekali
                        </div>
                        <div class="mt-2">
                            Warna: cerah sesuai keinginan saya
                        </div>
                        <div class="mt-2">
                            Celana yang enjoy dipakai warna sesuai ekspektasi dan penjual sangat cepat tanggap harga
                            juga sangat murah tapi barang gak murahan top markotop beli celana ternyaman disini aja.
                        </div>
                        <div class="mt-2 flex items-center">
                            <i class="fas fa-thumbs-up text-blue-500">
                            </i>
                            <div class="ml-2">
                                600
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Notifikasi checkout --}}
    @include('user.modals.modal-checkout-notifikasi')
    {{-- Modal Notifikasi checkout --}}
</div>