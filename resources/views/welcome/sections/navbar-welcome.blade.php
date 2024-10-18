<nav class="bg-transparent relative" x-data="{ isOpen: false }">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <!-- Logo -->
    <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
      <img src="/img/logo/logo-ym.svg" class="h-8" alt="Yayah Make up Logo" />
    </a>

    <!-- Right section with auth buttons and burger menu -->
    <div class="flex items-center md:order-2">
      <!-- Auth Buttons -->
      <div class="flex items-center">
        @guest('web')
        @guest('admin')
        <a href="{{ route('register') }}" wire:navigate
          class="text-white font-poppins text-sm text-center mr-3 hidden md:block">DAFTAR</a>
        <a href="{{ route('login') }}" wire:navigate
          class="text-ungu-dark bg-white hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold text-sm px-4 md:px-7 py-2 text-center whitespace-nowrap">MASUK</a>
        @endguest
        @endguest

        @auth('web')
        <a href="/home" wire:navigate
          class="text-ungu-dark bg-white hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold text-sm px-4 md:px-7 py-2 text-center">HOME</a>
        @endauth

        @auth('admin')
        <a href="/admin/dashboard" wire:navigate
          class="text-ungu-dark bg-white hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold text-sm px-4 md:px-7 py-2 text-center">DASHBOARD
          ADMIN</a>
        @endauth
      </div>

      <!-- Burger Menu Button -->
      <button type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-ungu-dark focus:outline-none focus:ring-2 focus:ring-gray-200 ml-2"
        @click="isOpen = !isOpen" @click.away="isOpen = false" :aria-expanded="isOpen">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
    </div>

    <!-- Navigation Menu (Mobile & Desktop) -->
    <div class="w-full md:flex md:w-auto md:order-1"
      :class="{'absolute top-full left-0 right-0 bg-black/80': !$screen('md')}"
      @click.away="if (!$screen('md')) isOpen = false">
      <!-- Mobile Menu (shown/hidden with x-show) -->
      <div class="md:hidden" x-show="isOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95" x-cloak>
        <ul class="flex flex-col font-poppins p-4 rounded-lg">
          <li>
            <a href="#beranda" class="block py-2 px-3 text-white hover:bg-ungu-dark/50 rounded-lg"
              @click="isOpen = false" aria-current="page">BERANDA</a>
          </li>
          <li>
            <a href="#layanan" class="block py-2 px-3 text-white hover:bg-ungu-dark/50 rounded-lg"
              @click="isOpen = false">LAYANAN</a>
          </li>
          <li>
            <a href="#dekorasi" class="block py-2 px-3 text-white hover:bg-ungu-dark/50 rounded-lg"
              @click="isOpen = false">DEKORASI</a>
          </li>
          <li>
            <a href="#wedding" class="block py-2 px-3 text-white hover:bg-ungu-dark/50 rounded-lg"
              @click="isOpen = false">GALLERY</a>
          </li>
          <li>
            <a href="#contact" class="block py-2 px-3 text-white hover:bg-ungu-dark/50 rounded-lg"
              @click="isOpen = false">CONTACT</a>
          </li>
          <!-- Mobile-only auth buttons -->
          @guest('web')
          @guest('admin')
          <li class="md:hidden">
            <a href="{{ route('register') }}" wire:navigate
              class="block py-2 px-3 text-white hover:bg-ungu-dark/50 rounded-lg" @click="isOpen = false">DAFTAR</a>
          </li>
          @endguest
          @endguest
        </ul>
      </div>

      <!-- Desktop Menu (always visible on md and up) -->
      <ul class="hidden md:flex font-poppins space-x-8 rtl:space-x-reverse items-center">
        <li>
          <a href="#beranda" class="block py-2 text-white hover:text-gray-100" aria-current="page">BERANDA</a>
        </li>
        <li>
          <a href="#layanan" class="block py-2 text-white hover:text-gray-100">LAYANAN</a>
        </li>
        <li>
          <a href="#dekorasi" class="block py-2 text-white hover:text-gray-100">DEKORASI</a>
        </li>
        <li>
          <a href="#wedding" class="block py-2 text-white hover:text-gray-100">GALLERY</a>
        </li>
        <li>
          <a href="#contact" class="block py-2 text-white hover:text-gray-100">CONTACT</a>
        </li>
      </ul>
    </div>
  </div>
</nav>