<!-- resources/views/emails/form-response.blade.php -->
@component('mail::message')
{{-- Header Image --}}
<div style="text-align: center; margin-bottom: 30px; margin-top: 15px;">
  <img
    src="https://raw.githubusercontent.com/anggarasa/yayah-make-up/refs/heads/main/public/img/logo/logo-ym-ungu-gambar.png"
    alt="Logo" style="max-width: 200px;">
</div>

# Pertanyaan Anda Telah Dijawab!

Hello {{ $question->name }},

Anda telah menerima jawaban pertanyaan dari Yayah Make Up.

@component('mail::panel')
## Pertanyaan Anda:
{{ $question->question }}
@endcomponent

@component('mail::panel')
## Jawaban:
{{ $question->answer }}
@endcomponent


Terimaksih,<br>
{{ config('app.name') }}
@endcomponent