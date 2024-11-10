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