<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\CategoryProduct;

new class extends Component
{
  public $categories;

  public function mount()
  {
    $this->categories = CategoryProduct::all();
  }
  
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }
}; ?>

<div>
  <nav class="bg-ungu-dark p-4 fixed z-30 w-full flex items-center justify-between">
    <div class="flex items-center">
      <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="/img/logo/logo-ym.svg" class="h-8" alt="Yayah Make up Logo" />
      </a>
    </div>
    <div class="flex items-center w-2/3">
      <input type="text" placeholder="Gratis Ongkir Rp0 s/d 60RB"
        class="w-full p-2 rounded-l-md border-none focus:outline-none">
      <button class="bg-white p-2 rounded-r-md">
        <i class="fas fa-search text-ungu-dark"></i>
      </button>
    </div>
    <div class="relative flex gap-x-4">
      <div>
        <i class="fa-solid fa-bell text-white text-2xl"></i>
        <span class="absolute top-0 right-0 bg-white text-ungu-dark text-xs rounded-full px-1">10</span>
      </div>
      <div>
        <i class="fas fa-shopping-cart text-white text-2xl"></i>
        <span class="absolute top-0 right-0 bg-white text-ungu-dark text-xs rounded-full px-1">10</span>
      </div>
    </div>
    <div class="relative" x-data="{ open: false }">
      <button type="button" @click="open = !open"
        class="flex mx-6 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300">
        <span class="sr-only">Open user menu</span>
        <img class="w-8 h-8 rounded-full"
          src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png" alt="user photo" />
      </button>

      <!-- Dropdown menu -->
      <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95" @click.away="open = false"
        class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10 origin-top-right">
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
        <a wire:click="logout" class="block px-4 py-2 cursor-pointer text-sm text-gray-700 hover:bg-gray-100">Logout</a>
      </div>
    </div>
  </nav>
  <div class="bg-ungu-dark p-2 fixed top-16 w-full flex justify-center space-x-4 text-white text-sm">
    @foreach ($categories as $category)
    <a href="{{ route('detail-category-user', $category->slug) }}" wire:navigate class="hover:underline">{{
      $category->name }}</a>

    @endforeach
  </div>
</div>