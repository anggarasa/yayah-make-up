<!-- Sidebar -->
<div class="bg-white w-full md:w-64 shadow-lg md:min-h-screen" x-data="{ profileDropdown: false }">
  <div class="p-4">
    <div class="text-center">
      @if (auth()->user()->profile)
      <img src="{{ asset('storage/uploads/profile/'. auth()->user()->profile) }}" alt="Profile"
        class="rounded-full w-28 mx-auto mb-4">
      @else
      <img src="/img/component/avatar.png" alt="Profile" class="rounded-full w-28 mx-auto mb-4">
      @endif
      <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>
      <p class="text-gray-600">{{ auth()->user()->phone_number }}</p>
    </div>

    <div class="mt-8 space-y-2">
      <div class="relative">
        <button @click="profileDropdown = !profileDropdown"
          class="w-full flex items-center p-2 text-gray-700 hover:bg-ungu-dark hover:text-white rounded">
          <i class="fas fa-user mr-3"></i>
          Profile
          <i class="fas fa-chevron-down ml-auto"></i>
        </button>
        <div x-show="profileDropdown" class="pl-8 space-y-2 mt-2">
          <a href="{{ route('profile-user', auth()->user()->username) }}"
            class="block p-2 text-gray-700 hover:bg-ungu-dark hover:text-white rounded">Detail Profile</a>
          <a href="#" class="block p-2 text-gray-700 hover:bg-ungu-dark hover:text-white rounded">Ubah Password</a>
        </div>
      </div>
      <a href="{{ route('myOrder-user') }}" wire:navigate
        class="flex items-center p-2 {{ request()->is('pesanan-saya') ? 'bg-ungu-dark text-white' : 'text-gray-700 hover:bg-ungu-dark hover:text-white' }} rounded">
        <i class="fas fa-shopping-cart mr-3"></i>
        Pesanan Saya
      </a>
      <a href="{{ route('user-notification') }}" wire:navigate
        class="flex items-center p-2 text-gray-700 hover:bg-ungu-dark hover:text-white rounded">
        <i class="fas fa-bell mr-3"></i>
        Notifikasi
      </a>
    </div>
  </div>
</div>