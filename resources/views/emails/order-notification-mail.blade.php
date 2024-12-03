{{-- Notification Admin New Order --}}
@if ($type == 'order_created')
@component('mail::message')
<div style="text-align: center; margin-bottom: 30px; margin-top: 15px;">
  <img
    src="https://raw.githubusercontent.com/anggarasa/yayah-make-up/refs/heads/main/public/img/logo/logo-ym-ungu-gambar.png"
    alt="Logo" style="max-width: 200px;">
</div>

# Notifikasi Pesanan Baru

{{ $order['customer_name'] }} telah membuat pesanan baru,

@component('mail::panel')
## Detail pesanan:
- Order ID: {{ $order['order_id'] }}
- Produk: {{ $order['product_name'] }}
- Total Harga: Rp. {{ number_format($order['total_harga']) }}
@endcomponent

@component('mail::button', ['url' => url('/admin/order/show-order/' . $order['order_id'])])
Lihat Detail Pesanan
@endcomponent

@endcomponent


@elseif ($type == 'payment_success')
@component('mail::message')
<div style="text-align: center; margin-bottom: 30px; margin-top: 15px;">
  <img
    src="https://raw.githubusercontent.com/anggarasa/yayah-make-up/refs/heads/main/public/img/logo/logo-ym-ungu-gambar.png"
    alt="Logo" style="max-width: 200px;">
</div>

# Notifikasi Pesanan Baru

{{ $order['customer_name'] }} telah membayar pesanan yang dipesan,

@component('mail::panel')
## Detail pesanan:
- Order ID: {{ $order['order_id'] }}
- Produk: {{ $order['product_name'] }}
- Status Pembayaran: {{ $order['status_payment'] }}
- Metode Pembayaran: {{ $order['payment_type'] }}
- Total Harga: Rp. {{ number_format($order['total_harga']) }}
@endcomponent

@component('mail::button', ['url' => url('/admin/order/show-order/' . $order['order_id'])])
Lihat Detail Pesanan
@endcomponent

@endcomponent

@elseif ($type == 'order_cancel')
@component('mail::message')
<div style="text-align: center; margin-bottom: 30px; margin-top: 15px;">
  <img
    src="https://raw.githubusercontent.com/anggarasa/yayah-make-up/refs/heads/main/public/img/logo/logo-ym-ungu-gambar.png"
    alt="Logo" style="max-width: 200px;">
</div>

# Notifikasi Pesanan Baru

{{ $order['customer_name'] }} telah membatalkan pesanan yang dipesan,

@component('mail::panel')
## Detail pesanan:
- Order ID: {{ $order['order_id'] }}
- Produk: {{ $order['product_name'] }}
- Status Produk: {{ $order['status'] }}
- Metode Pembayaran: @if ($order && $order['payment_type'] !== null && $order['payment_type']->isNotEmpty()) {{
$order['payment_type'] }} @else Tidak ada pembayaran @endif
- Total Harga: Rp. {{ number_format($order['total_harga']) }}
@endcomponent

@component('mail::button', ['url' => url('/admin/order/show-order/' . $order['order_id'])])
Lihat Detail Pesanan
@endcomponent

@endcomponent

{{-- Notification User New Order --}}
@elseif ($type == 'update_status_order')
@if ($order['status'] == 'diproses')
@component('mail::message')
<div style="text-align: center; margin-bottom: 30px; margin-top: 15px;">
  <img
    src="https://raw.githubusercontent.com/anggarasa/yayah-make-up/refs/heads/main/public/img/logo/logo-ym-ungu-gambar.png"
    alt="Logo" style="max-width: 200px;">
</div>

# Notifikasi Pesanan

Halo {{ $order['customer_name'] }} pesanan anda telah dikonfirmasi sekaran sedang diproses,

@component('mail::panel')
## Pesanan Anda dengan detail:
- Order ID: {{ $order['order_id'] }}
- Produk: {{ $order['product_name'] }}
- Status Produk: {{ $order['status'] }}
- Metode Pembayaran: {{$order['payment_type'] }}
- Total Harga: Rp. {{ number_format($order['total_harga']) }}
@endcomponent

@component('mail::button', ['url' => url('/detail/pesanan-saya/' . $order['order_id'])])
Lihat Detail Pesanan
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent

@elseif($order['status'] == 'dikirim')
@component('mail::message')
<div style="text-align: center; margin-bottom: 30px; margin-top: 15px;">
  <img
    src="https://raw.githubusercontent.com/anggarasa/yayah-make-up/refs/heads/main/public/img/logo/logo-ym-ungu-gambar.png"
    alt="Logo" style="max-width: 200px;">
</div>

# Notifikasi Pesanan

Halo {{ $order['customer_name'] }} pesanan anda akan dikirim ke alamat tempat lokasi acara,

@component('mail::panel')
## Pesanan Anda dengan detail:
- Order ID: {{ $order['order_id'] }}
- Produk: {{ $order['product_name'] }}
- Status Produk: {{ $order['status'] }}
- Total Harga: Rp. {{ number_format($order['total_harga']) }}
@endcomponent

@component('mail::button', ['url' => url('/detail/pesanan-saya/' . $order['order_id'])])
Lihat Detail Pesanan
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent

@elseif ($order['status'] == 'selesai')
@component('mail::message')
<div style="text-align: center; margin-bottom: 30px; margin-top: 15px;">
  <img
    src="https://raw.githubusercontent.com/anggarasa/yayah-make-up/refs/heads/main/public/img/logo/logo-ym-ungu-gambar.png"
    alt="Logo" style="max-width: 200px;">
</div>

# Notifikasi Pesanan

Halo {{ $order['customer_name'] }} terimakasi sudah menggunakan layanan kami,

@component('mail::panel')
## Pesanan Anda dengan detail:
- Order ID: {{ $order['order_id'] }}
- Produk: {{ $order['product_name'] }}
- Status Produk: {{ $order['status'] }}
- Metode Pembayaran: @if ($order && $order['payment_type'] !== null && $order['payment_type']->isNotEmpty()) {{
$order['payment_type'] }} @else Tidak ada pembayaran @endif
- Total Harga: Rp. {{ number_format($order['total_harga']) }}
@endcomponent

@component('mail::button', ['url' => url('/detail/pesanan-saya/' . $order['order_id'])])
Lihat Detail Pesanan
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent

@endif
@endif