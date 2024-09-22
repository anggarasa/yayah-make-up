<x-welcome-layout>
  {{-- Beranda Start --}}
  <section id="beranda" class="bg-ungu-linear-bawah min-h-screen">
    <div class="bg-titik min-h-screen">
      {{-- Navbar --}}
      @include('welcome.sections.navbar-welcome')

      {{-- Beranda Content --}}
      @include('welcome.sections.beranda-content-welcome')
    </div>
  </section>
  {{-- Beranda End --}}

  {{-- Layanan Start --}}
  <section id="layanan" class="bg-gray-100 mt-10">
    @include('welcome.sections.layanan-welcome');
  </section>
  {{-- Layanan End --}}

  {{-- Dekorasi Start --}}
  <section id="dekorasi" class="bg-gray-100 mt-10">
    @include('welcome.sections.dekorasi-welcome')
  </section>
  {{-- Dekorasi End --}}

  {{-- Wedding Gallery Start --}}
  <section id="wedding" class="bg-gray-100">
    @include('welcome.sections.wedding-welcome')
  </section>
  {{-- Wedding Gallery End --}}


  {{-- Contact Start --}}
  <section id="contact" class="min-h-screen bg-cover "
    style="background-image: url('/img/component/bg-foter-welcome.jpg')">
    @include('welcome.sections.contact-welcome')
  </section>
  {{-- Contact End --}}


  {{-- Footer Start --}}
  <footer class="bg-gray-900">
    @include('welcome.sections.footer-welcome')
  </footer>
  {{-- Footer End --}}
</x-welcome-layout>