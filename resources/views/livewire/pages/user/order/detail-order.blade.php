<div class="min-h-screen" x-data="{ showModal: false }">
    <!-- Header Mobile -->
    <div class="lg:hidden bg-white shadow-sm p-4 fixed top-16 w-full z-10">
        <div class="flex items-center justify-between">
            <button class="text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <h1 class="text-lg font-semibold">Detail Pesanan</h1>
            <div class="w-6"></div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 lg:pb-12 lg:mt-0">
        <div class="max-w-4xl mx-auto">
            <!-- Desktop Header -->
            <h1 class="hidden lg:block text-2xl font-bold mb-8">Detail Pesanan</h1>

            <!-- Card Produk -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="w-full md:w-1/3">
                        <img src="{{ asset('storage/'. $order->product->cover_image) }}"
                            class="w-full h-48 object-cover rounded-lg" alt="Produk">
                    </div>
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold mb-2">{{ $order->product->title }}</h2>

                        <div class="flex flex-wrap gap-10">
                            @if ($order->akadDress)
                            @php
                            $akad = $order->akadDress
                            @endphp
                            <div>
                                <p class="text-sm text-gray-500">{{ $akad->name }}</p>
                                <div class="border w-32 rounded-lg p-2">
                                    <img src="{{ asset('storage/file-dress/'. $akad->image_dress) }}"
                                        class="w-32 h-32 rounded-lg object-cover mb-2" alt="{{ $akad->name }}">
                                    <p class="text-sm text-center">{{ $akad->name }}</p>
                                </div>
                            </div>
                            @endif

                            @if ($order->resepsiDresses)
                            @foreach ($order->resepsiDresses as $resepsi)
                            <div>
                                <p class="text-sm text-gray-500">{{ $resepsi->name }}</p>
                                <div class="flex items-center space-x-4">
                                    <div class="border w-32 rounded-lg p-2">
                                        <img src="{{ asset('storage/file-dress/'. $resepsi->image_dress) }}"
                                            class="w-32 h-32 rounded-lg object-cover mb-2" alt="{{ $resepsi->name }}">
                                        <p class="text-sm text-center">{{ $resepsi->name }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>

                        @if(!$order->akadDress && !$order->resepsiDresses->count() && $order->product &&
                        $order->product->description)
                        <div class="text-gray-600 mb-4 quill-content">
                            {!! Str::limit($order->product->description, 500, '...') !!}
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Status Pembayaran -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Status Pembayaran</h3>

                @if($order->status_payment == 'pending')
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fa-regular fa-clock text-xl text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-yellow-600">Menunggu Pembayaran</p>
                        <p class="text-sm text-gray-500">Bayar sebelum 24 jam</p>
                    </div>
                </div>
                @endif

                @if($order->status_payment == 'settlement')
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                        <i class="fa-solid fa-check text-xl text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-green-600">Pembayaran Berhasil</p>
                        <p class="text-sm text-gray-500">Pesanan anda akan diproses</p>
                    </div>
                </div>
                @endif

                @if($order->status_payment == 'cancel')
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fa-solid fa-x text-xl text-red-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-red-600">Pembayaran Gagal</p>
                        <p class="text-sm text-gray-500">Anda harus memesan kembali paket pernikahan</p>
                    </div>
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
                        Kembali
                    </a>

                    @if ($order->status === 'pembayaran' && $order->status_payment === 'pending')
                    <button wire:click="payment"
                        class="flex-1 bg-ungu-dark hover:bg-ungu-dark/90 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                        Bayar
                    </button>
                    @elseif ($order->status === 'diproses')
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