<div>
    <div class="container mx-auto p-4">
        <!-- Heading & Filters -->
        <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
            <div>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard-admin') }}"
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
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-ungu-dark md:ms-2">List-Product</a>
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
                <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Product Detail</h2>
            </div>
        </div>


        <div class="bg-white p-4 rounded shadow">
            <div class="md:flex">
                <div class="md:w-1/2">
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
                    <p class="text-center text-gray-500">No mediaProducts found.</p>
                    @endif

                    <!-- Penilaian Produk dan Rating -->
                    <div class="md:mt-8 md:pl-6 hidden md:block">
                        <div class="text-lg font-bold mb-2">
                            Penilaian Produk
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-yellow-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <svg class="w-4 h-4 text-gray-300 me-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path
                                    d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                            </svg>
                            <p class="ms-1 text-sm font-medium text-gray-500">4.95</p>
                            <p class="ms-1 text-sm font-medium text-gray-500">out of</p>
                            <p class="ms-1 text-sm font-medium text-gray-500">5</p>
                        </div>
                        <p class="text-sm font-medium text-gray-500">1,745 global ratings</p>
                        <div class="flex items-center mt-4">
                            <a href="#" class="text-sm font-medium text-ungu-dark hover:underline">5
                                star</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-yellow-300 rounded" style="width: 70%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">70%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <a href="#" class="text-sm font-medium text-ungu-dark hover:underline">4
                                star</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-yellow-300 rounded" style="width: 17%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">17%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <a href="#" class="text-sm font-medium text-ungu-dark hover:underline">3
                                star</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-yellow-300 rounded" style="width: 8%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">8%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <a href="#" class="text-sm font-medium text-ungu-dark hover:underline">2
                                star</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-yellow-300 rounded" style="width: 4%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">4%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <a href="#" class="text-sm font-medium text-ungu-dark hover:underline">1
                                star</a>
                            <div class="w-2/4 h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                                <div class="h-5 bg-yellow-300 rounded" style="width: 1%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">1%</span>
                        </div>
                    </div>
                </div>

                <div class="md:w-1/2 p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->title }}</h2>
                    <p class="text-gray-600 text-sm mb-4">SKU: 123456</p>

                    <div class="mb-4">
                        <span class="text-3xl font-bold text-ungu-white">{{ $product->formatted_harga }}</span>
                        <span class="text-sm text-gray-500 line-through ml-2">Rp 1.299.000</span>
                    </div>

                    <div class="mb-4">
                        <div class="text-lg font-bold mb-2">
                            Deskripsi Produk :
                        </div>
                        <div class="quill-content">
                            {!! $product->description !!}
                        </div>
                    </div>

                    <!-- Pilihan Baju Pernikahan -->
                    <div>
                        @if ($product->dresses->isNotEmpty())
                        <h3 class="text-lg font-bold text-black mb-2">Pilih baju pernikahan anda :</h3>
                        @endif

                        <div class="ml-5 mb-4">
                            @if ($product->dresses->where('dress_type', 'Akad')->isNotEmpty())
                            <h3 class="text-sm font-semibold text-gray-700 mb-2">Baju Akad :</h3>

                            <div class="flex space-x-2">
                                @foreach ($product->dresses->where('dress_type', 'Akad') as $akad)
                                <label
                                    class="flex items-center border-2 border-gray-300 rounded p-2 cursor-pointer has-[:checked]:border-ungu-dark">
                                    <input type="checkbox" class="hidden peer" />
                                    <img alt="White T-shirt" class="w-8 h-8 object-cover"
                                        src="{{ asset('storage/file-dress/'. $akad->image_dress) }}" width="30" />
                                    <span
                                        class="ml-2 text-gray-700 peer-checked:text-ungu-dark peer-checked:font-semibold">{{
                                        $akad->name }}</span>
                                </label>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        <div class="ml-5 mb-4">
                            @if ($product->dresses->where('dress_type', 'Resepsi')->isNotEmpty())
                            <h3 class="text-sm font-semibold text-gray-700 mb-2">Baju Resepsi</h3>

                            <div class="flex space-x-2">
                                @foreach ($product->dresses->where('dress_type', 'Resepsi') as $resepsi)
                                <label
                                    class="flex items-center border-2 border-gray-300 rounded p-2 cursor-pointer has-[:checked]:border-ungu-dark">
                                    <input type="checkbox" class="hidden peer" />
                                    <img alt="White T-shirt" class="w-8 h-8 object-cover"
                                        src="{{ asset('storage/file-dress/'. $resepsi->image_dress) }}" width="30" />
                                    <span
                                        class="ml-2 text-gray-700 peer-checked:text-ungu-dark peer-checked:font-semibold">{{
                                        $resepsi->name }}</span>
                                </label>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tombol Beli -->
                    <div class="flex justify-between items-center space-x-4">
                        <button type="button"
                            class="w-full bg-transparent text-ungu-dark py-2 px-4 rounded-md hover:bg-gray-100 border border-ungu-dark focus:outline-none focus:ring-2 focus:ring-ungu-white focus:ring-offset-2 cursor-not-allowed">
                            Tambahkan ke Keranjang
                        </button>
                        <button type="button"
                            class="w-full bg-ungu-dark text-white py-2 px-4 rounded-md hover:bg-ungu-white focus:outline-none focus:ring-2 focus:ring-ungu-dark focus:ring-offset-2 cursor-not-allowed">
                            Sewa Sekarang
                        </button>
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
</div>