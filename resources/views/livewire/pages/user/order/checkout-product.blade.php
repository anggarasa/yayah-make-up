<div>
    <div class="min-h-screen">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="bg-ungu-dark py-6">
                    <h2 class="text-center text-2xl font-bold text-white">Checkout</h2>
                </div>

                <div class="p-6 grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Product Info -->
                    <div class="space-y-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold mb-4">Informasi Produk</h3>
                            <div class="flex space-x-4">
                                <img src="{{ asset('storage/'. $product->cover_image) }}"
                                    class="w-24 h-24 rounded-lg object-cover" alt="">
                                <div>
                                    <h4 class="font-semibold">{{ $product->title }}</h4>
                                    <p class="text-gray-600">Dokumentasi + Dekorasi + Catering</p>
                                    <p class="text-ungu-dark font-semibold mt-2">{{ $product->formatted_harga }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Baju Akad dan Resepsi -->
                        <div class="mt-6">
                            @if($product->dresses()->exists())
                            @if ($akadDressId)
                            <h4 class="font-semibold mb-4">Pilihan Baju</h4>

                            <!-- Baju Akad -->
                            <div class="mb-4">
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Baju Akad</h5>
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="border w-32 rounded-lg p-2">
                                        <img src="{{ asset('storage/file-dress/'.$akadDressId->image_dress) }}"
                                            class="w-32 h-32 rounded-lg object-cover mb-2" alt="">
                                        <p class="text-sm text-center">{{ $akadDressId->name }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Baju Resepsi -->
                            @if ($resepsiDressIds->isNotEmpty())
                            <div>
                                <h5 class="text-sm font-medium text-gray-700 mb-2">Baju Resepsi</h5>
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach ($resepsiDressIds as $dressId)
                                    <div class="border w-44 rounded-lg p-2">
                                        <img src="{{ asset('storage/file-dress/'. $dressId->image_dress) }}"
                                            class="w-52 h-32 rounded-lg object-cover mb-2" alt="">
                                        <p class="text-sm text-center">{{ $dressId->name }}</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @endif
                        </div>

                        {{-- Code Diskon Produk chek --}}
                        <form wire:submit="checkKodeDiskon" class="max-w-md mt-4">
                            <label for="diskon_code"
                                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Code
                                Diskon</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <i class="fa-solid fa-percent text-base text-gray-500"></i>
                                </div>
                                <input type="text" id="diskon_code" wire:model="diskon_code"
                                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-ungu-dark focus:border-ungu-dark"
                                    placeholder="Code Diskon" />
                                <button type="submit"
                                    class="text-white absolute end-2.5 bottom-1.5 bg-ungu-dark hover:bg-ungu-white focus:ring-4 focus:outline-none focus:ring-ungu-tipis font-medium rounded-lg text-sm px-3 py-1">Check</button>
                            </div>
                            @if (session()->has('diskon_success'))
                            <p class="mt-2 text-sm text-green-600 dark:text-green-500">{{
                                session('diskon_success') }}</p>
                            @endif
                            @if (session()->has('diskon_error'))
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{
                                session('diskon_error') }}</p>
                            @endif
                        </form>


                        <!-- Payment Type -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="space-y-4">
                                {{-- <label class="flex items-center space-x-3">
                                    <input type="radio" name="paymnet" x-model="tipePembayaran" wire:model="paymentType"
                                        value="full" class="h-4 w-4 text-ungu-dark focus:ring-ungu-dark">
                                    <span>Pembayaran Penuh</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="paymnet" x-model="tipePembayaran" wire:model="paymentType"
                                        value="dp" class="h-4 w-4 text-ungu-dark focus:ring-ungu-dark">
                                    <span>DP 50%</span>
                                </label>
                                <x-input-error :messages="$errors->get('paymentType')" class="mt-2" /> --}}
                                <div class="mt-4">
                                    <p class="font-semibold">Total Pembayaran:</p>
                                    <p class="text-ungu-dark text-xl font-bold">Rp {{ number_format($totalHarga, 0, ',',
                                        '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <form class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" wire:model="customer_name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark">
                            <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" wire:model="customer_email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark">
                            <x-input-error :messages="$errors->get('customer_email')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. Handphone</label>
                            <input type="tel" wire:model="customer_phone"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark">
                            <x-input-error :messages="$errors->get('customer_phone')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea wire:model="customer_address"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark"
                                rows="3"></textarea>
                            <x-input-error :messages="$errors->get('customer_address')" class="mt-2" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pernikahan</label>
                            <input type="date" wire:model="tanggal_pernikahan"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-ungu-dark focus:ring-ungu-dark">
                            <x-input-error :messages="$errors->get('tanggal_pernikahan')" class="mt-2" />
                        </div>

                        <div wire:loading.flex
                            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                            <div class="bg-white p-8 rounded-2xl shadow-xl flex flex-col items-center gap-4">
                                <svg class="w-12 h-12 text-gray-200 animate-spin" viewBox="0 0 100 101" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path class="fill-purple-800"
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" />
                                </svg>
                                <span class="text-gray-600 font-medium">Loading...</span>
                            </div>
                        </div>

                        <div class="flex space-x-4">
                            <button type="button" @click="$dispatch('modal-confirm-checkout')"
                                class="flex-1 py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Batal
                            </button>
                            <button type="button" wire:click="processCheckout"
                                class="flex-1 py-2 px-4 border border-transparent rounded-md text-sm font-medium text-white bg-ungu-dark hover:bg-[#6A189C]">
                                Lanjut Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal checkout --}}
    @include('user.modals.modal-checkout-notifikasi')
    {{-- Modal checkout --}}
</div>