<div class="min-h-screen" x-data="{ showModal: false }">
    <!-- Header Mobile -->
    <div class="lg:hidden bg-white shadow-sm p-4 fixed top-16 w-full z-10">
        <div class="flex items-center justify-between">
            <a href="{{ route('myOrder-user') }}" wire:navigate class="text-gray-600">
                <i class="fa-solid fa-angle-left text-2xl"></i>
            </a>
            <h1 class="text-lg font-semibold">Detail Pesanan</h1>
            <div class="w-6"></div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 md:mt-10 lg:pb-12 lg:mt-0">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('myOrder-user') }}" wire:navigate class="hidden lg:inline-flex items-center gap-2 mb-6 text-gray-700 hover:text-ungu-dark transition-colors
            duration-200 rounded-lg hover:bg-gray-100">
                <i class="fa-solid fa-arrow-left text-xl"></i>
                <span class="font-medium">Kembali</span>
            </a>
            <!-- Desktop Header -->
            <h1 class="hidden lg:block text-2xl font-bold mb-8">Detail Pesanan</h1>

            <!-- Card Produk -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Gambar Produk -->
                    <div class="w-full md:w-1/3">
                        <img src="{{ asset('storage/'. $order->product->cover_image) }}"
                            class="w-full h-48 object-cover rounded-lg" alt="Produk">
                    </div>

                    <!-- Detail Produk dan Informasi Pelanggan -->
                    <div class="flex-1">
                        <!-- Judul Produk -->
                        <h2 class="text-xl font-semibold mb-2">{{ $order->product->title }}</h2>

                        <!-- Kategori Produk -->
                        <p class="text-sm text-gray-500 mb-4">Kategori: {{ $order->product->categoryProduct->name ??
                            'Tidak ada
                            kategori' }}</p>

                        <!-- Deskripsi Produk -->
                        <div x-data="{ expanded: false }" class="mb-4">
                            <h3 class="text-lg font-semibold">Deskripsi</h3>
                            <div class="text-gray-700 quill-content">
                                @if(strlen($order->product->description) > $descriptionLimit)
                                <div x-show="!expanded">
                                    {!! Str::limit($order->product->description, $descriptionLimit, '') !!}
                                    <span class="text-gray-400">...</span>
                                </div>
                                <div x-show="expanded" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0">
                                    {!! $order->product->description !!}
                                </div>
                                <button @click="expanded = !expanded"
                                    class="mt-2 text-[#7A1CAC] hover:text-[#6A189C] text-sm font-medium focus:outline-none">
                                    <span x-text="expanded ? 'Lihat lebih sedikit' : 'Lihat lebih banyak'"></span>
                                </button>
                                @else
                                {!! $order->product->description !!}
                                @endif
                            </div>
                        </div>

                        <!-- Informasi Customer -->
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Informasi Pelanggan</h3>
                            <p class="text-sm text-gray-500">Nama: {{ $order->customer_name }}</p>
                            <p class="text-sm text-gray-500">Email: {{ $order->customer_email }}</p>
                            <p class="text-sm text-gray-500">Nomor Telepon: {{ $order->customer_phone }}</p>
                            <p class="text-sm text-gray-500">Alamat: {{ $order->customer_address }}</p>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-lg font-semibold">Tanggal Acara</h3>
                            <p class="text-sm text-gray-500">Tanggal Pernikahan: {{
                                \Carbon\Carbon::parse($order->tanggal_pernikahan)->format('d M Y') }}</p>
                        </div>

                        <!-- Pilihan Gaun Akad dan Resepsi -->
                        <div class="flex flex-wrap gap-10">
                            <!-- Gaun Akad -->
                            @if ($order->akadDress)
                            @php
                            $akad = $order->akadDress;
                            @endphp
                            <div>
                                <p class="text-sm text-gray-500">Gaun Akad</p>
                                <div class="border w-32 rounded-lg p-2">
                                    <img src="{{ asset('storage/file-dress/'. $akad->image_dress) }}"
                                        class="w-32 h-32 rounded-lg object-cover mb-2" alt="{{ $akad->name }}">
                                    <p class="text-sm text-center">{{ $akad->name }}</p>
                                </div>
                            </div>
                            @endif

                            <!-- Gaun Resepsi -->
                            @if ($order->resepsiDresses)
                            @foreach ($order->resepsiDresses as $resepsi)
                            <div>
                                <p class="text-sm text-gray-500">Gaun Resepsi</p>
                                <div class="border w-32 rounded-lg p-2">
                                    <img src="{{ asset('storage/file-dress/'. $resepsi->image_dress) }}"
                                        class="w-32 h-32 rounded-lg object-cover mb-2" alt="{{ $resepsi->name }}">
                                    <p class="text-sm text-center">{{ $resepsi->name }}</p>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>


            <!-- Status Pembayaran -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Status Pembayaran</h3>

                @if($order->status === 'pembayaran')
                @if($order->status_payment === 'pending')
                <div class="flex items-center space-x-3 p-4 bg-yellow-100 text-yellow-700 rounded-lg">
                    <i class="fas fa-clock text-2xl"></i>
                    <div>
                        <p class="font-semibold">Menunggu Pembayaran</p>
                        <p class="text-sm">Silahkan lakukan pembayaran untuk melanjutkan.</p>
                    </div>
                </div>
                @elseif($order->status_payment === 'settlement')
                <div class="flex items-center space-x-3 p-4 bg-green-100 text-green-700 rounded-lg">
                    <i class="fas fa-check-circle text-2xl"></i>
                    <div>
                        <p class="font-semibold">Pembayaran Berhasil</p>
                        <p class="text-sm">Order akan segera diproses.</p>
                    </div>
                </div>
                @elseif(in_array($order->status_payment, ['failed', 'deny']))
                <div class="flex items-center space-x-3 p-4 bg-red-100 text-red-700 rounded-lg">
                    <i class="fas fa-times-circle text-2xl"></i>
                    <div>
                        <p class="font-semibold">Pembayaran Gagal</p>
                        <p class="text-sm">Silahkan coba kembali untuk melakukan pembayaran.</p>
                    </div>
                </div>
                @elseif($order->status_payment === 'expired')
                <div class="flex items-center space-x-3 p-4 bg-gray-100 text-gray-700 rounded-lg">
                    <i class="fas fa-exclamation-circle text-2xl"></i>
                    <div>
                        <p class="font-semibold">Pembayaran Kadaluarsa</p>
                        <p class="text-sm">Waktu pembayaran telah berakhir.</p>
                    </div>
                </div>
                @endif
                @else
                <!-- Order Status -->
                <div class="space-y-2">
                    @if($order->status === 'diproses')
                    <div class="flex items-center space-x-3 p-4 bg-blue-100 text-blue-700 rounded-lg">
                        <i class="fas fa-spinner text-2xl"></i>
                        <div>
                            <p class="font-semibold">Pesanan Sedang Diproses</p>
                            <p class="text-sm">Admin akan mengabari 1 minggu sebelum tanggal pernikahan.
                            </p>
                        </div>
                    </div>
                    @elseif($order->status === 'dikirim')
                    <div class="flex items-center space-x-3 p-4 bg-purple-100 text-purple-700 rounded-lg">
                        <i class="fas fa-truck text-2xl"></i>
                        <div>
                            <p class="font-semibold">Dekorasi Sedang Dikirim</p>
                            <p class="text-sm">Dekorasi akan segera tiba di alamat tujuan.</p>
                        </div>
                    </div>
                    @elseif($order->status === 'selesai')
                    <div class="flex items-center space-x-3 p-4 bg-green-100 text-green-700 rounded-lg">
                        <i class="fas fa-check-circle text-2xl"></i>
                        <div>
                            <p class="font-semibold">Pesanan Selesai</p>
                            <p class="text-sm">Terima kasih telah menggunakan layanan kami.</p>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <div class="border-t pt-4">
                    {{-- <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Subtotal Produk</span>
                        <span class="font-medium">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Tipe Pembayaran</span>
                        @if ($order->payment_type == 'dp')
                        <span class="font-medium">DP 50%</span>
                        @else
                        <span class="font-medium">Pembayaran Penuh</span>
                        @endif
                    </div> --}}
                    <div class="flex justify-between mt-4 pt-4 border-t">
                        <span class="font-semibold">Total Pembayaran</span>
                        <span class="font-semibold text-ungu-dark">Rp {{ number_format($order->total_harga, 0, ',',
                            '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Tombol Bayar -->
            <div class="fixed bottom-0 left-0 right-0 bg-white p-4 shadow-lg lg:relative lg:shadow-none lg:p-0">
                <div class="flex space-x-2">
                    <a href="{{ route('myOrder-user') }}" wire:navigate
                        class="flex-1 text-center bg-transparent border border-ungu-dark hover:bg-ungu-tipis text-ungu-dark font-semibold py-3 px-6 rounded-lg transition duration-200">
                        Batalkan Pesanan
                    </a>

                    @if ($order->status_payment === 'pending' || $order->status_payment == 'deny' ||
                    $order->status_payment == 'failed' || $order->status_payment == 'expire')
                    <button wire:click="payment" wire:loading.attr="disabled"
                        class="flex-1 bg-ungu-dark hover:bg-ungu-dark/90 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                        Bayar
                    </button>
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
                    @elseif ($order->status_payment === 'settlement')
                    <button wire:click="contactSeller"
                        class="flex-1 bg-ungu-dark hover:bg-ungu-dark/90 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                        Hubungi Penjual
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Modal notification --}}
    @include('user.modals.modal-checkout-notifikasi')
    {{-- Modal notification --}}

    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('payment-order', (event) => {
                const snapToken = event[0].snapToken;
                snap.pay(snapToken, {
                    onSuccess: function(result){
                        @this.handlePaymentSuccess(result);
                    },
                    onPending: function(result){
                        @this.handlePaymentError(result);
                    },
                    onError: function(result){
                        @this.handlePaymentError(result);
                    }
                });
            });
        });
    </script>
</div>