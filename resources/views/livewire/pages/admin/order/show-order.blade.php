<div>
    <div class="min-h-screen bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            <!-- Card Detail Order -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-[#7A1CAC] flex items-center justify-between px-6 py-4">
                    <h1 class="text-white text-xl md:text-2xl font-semibold">Detail Order #{{ Str::limit($order->id, 5,
                        '...') }}</h1>
                    <a href="{{ route('order.daftar-order') }}" wire:navigate
                        class="text-white text-lg hover:text-gray-300">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <!-- Product Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="space-y-4">
                            <img src="{{ asset('storage/'. $order->product->cover_image) }}"
                                alt="{{ $order->product->title }}"
                                class="w-full h-64 md:h-80 object-cover object-center">

                            <!-- Payment Status -->
                            <div class="space-y-2">
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
                                    <div
                                        class="flex items-center space-x-3 p-4 bg-purple-100 text-purple-700 rounded-lg">
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
                            </div>
                        </div>

                        <div x-data="{ expanded: false }" class="space-y-4">
                            <h2 class="text-2xl font-bold text-gray-800">{{ $order->product->title }}</h2>
                            <div class="text-gray-700 quill-content">
                                <h3 class="text-xl font-bold text-gray-800">Deskripsi :</h3>
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
                            <div class="space-y-4">
                                <p class="text-gray-600">
                                    <span class="font-bold text-ungu-dark">Kategori:</span>
                                    {{ $order->product->categoryProduct->name }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-bold text-ungu-dark">Harga:</span>
                                    Rp {{ number_format($order->product->harga, 0, ',', '.') }}
                                </p>
                            </div>

                            <!-- Desktop Status (Hidden on mobile) -->
                            @if($order->status === 'pembayaran' && $order->status_payment === 'settlement' ||
                            $order->status === 'diproses' ||
                            $order->status === 'dikirim')
                            <div class="block">
                                <div class="flex items-center gap-4">
                                    <span class="text-ungu-dark font-bold">Status Order:</span>
                                    <div class="flex items-center gap-3">
                                        <span class="px-4 py-2 rounded-full text-white
                                        {{ $order->status === 'pending' ? 'bg-yellow-500' : 
                                        ($order->status === 'processing' ? 'bg-blue-500' : 
                                        ($order->status === 'shipped' ? 'bg-purple-500' : 
                                        ($order->status === 'completed' ? 'bg-green-500' : 'bg-red-500'))) }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                        <select wire:model="orderStatus"
                                            class="form-select rounded-md border-gray-300 shadow-sm focus:border-[#7A1CAC] focus:ring focus:ring-[#7A1CAC] focus:ring-opacity-50">
                                            <option value="">Ubah status</option>
                                            <option value="processing">Diproses</option>
                                            <option value="shipped">Dikirim</option>
                                            <option value="completed">Selesai</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="border-t pt-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Informasi Pemesan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-3">
                                <p class="text-gray-600">
                                    <span class="font-bold text-ungu-dark">Nama Lengkap:</span>
                                    {{ $order->customer_name }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-bold text-ungu-dark">Email:</span>
                                    {{ $order->customer_email }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-bold text-ungu-dark">No. HP:</span>
                                    {{ $order->customer_phone }}
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-bold text-ungu-dark">Tanggal Pernikahan:</span>
                                    {{ \Carbon\Carbon::parse($order->tanggal_pernikahan)->format('d M Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600">
                                    <span class="font-bold text-ungu-dark">Alamat:</span><br>
                                    {{ $order->customer_address }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Wedding Outfits (if available) -->
                    @if($order->akadDress || $order->resepsiDresses->count() > 0)
                    <div class="border-t pt-6 mt-6 space-y-6">
                        <h3 class="text-xl font-semibold text-gray-800">Pakaian Pernikahan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                            <!-- Baju Akad (One to Many) -->
                            @if($order->akadDress)
                            <div class="bg-white shadow-md rounded-lg p-5 space-y-4">
                                <h4 class="text-lg font-semibold text-gray-700">Baju Akad</h4>
                                <img src="{{ asset('storage/file-dress/'. $order->akadDress->image_dress) }}"
                                    alt="{{ $order->akadDress->name }}"
                                    class="w-full h-64 md:h-80 object-cover object-center rounded-md">
                                <p class="text-sm text-gray-600">{{ $order->akadDress->name }}</p>
                            </div>
                            @endif

                            <!-- Baju Resepsi (Many to Many) -->
                            @if($order->resepsiDresses->count() > 0)
                            <div class="bg-white shadow-md rounded-lg p-5 space-y-4">
                                <h4 class="text-lg font-semibold text-gray-700">Baju Resepsi</h4>
                                <div class="space-y-4">
                                    @foreach($order->resepsiDresses as $resepsiDress)
                                    <div class="border border-gray-200 rounded-md overflow-hidden shadow-sm">
                                        <img src="{{ asset('storage/file-dress/'. $resepsiDress->image_dress) }}"
                                            alt="{{ $resepsiDress->name }}"
                                            class="w-full h-64 md:h-80 object-cover object-center">
                                        <div class="p-4">
                                            <p class="text-sm font-medium text-gray-700">{{ $resepsiDress->name }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>