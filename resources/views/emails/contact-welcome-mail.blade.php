<!-- resources/views/emails/form-response.blade.php -->
@component('mail::message')
{{-- Header Image --}}
<div style="text-align: center; margin-bottom: 30px; margin-top: 15px;">
  <img
    src="https://raw.githubusercontent.com/anggarasa/yayah-make-up/refs/heads/main/public/img/logo/logo-ym-ungu-gambar.png"
    alt="Logo" style="max-width: 200px;">
</div>

# Respon Baru Diterima!

Hello Yayah Make Up,

Anda telah menerima respons baru dari formulir kontak situs web Anda.

@component('mail::panel')
## Rincian Respons
**Name:** {{ $name }}<br>
**Email:** {{ $email }}
@endcomponent

@component('mail::panel')
## Konten Pertanyaan
{{ $message }}
@endcomponent

@component('mail::subcopy')
Ini adalah pesan otomatis dari formulir kontak situs web Anda.
@endcomponent

Terimaksih,<br>
{{ config('app.name') }}
@endcomponent