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

<nav class="bg-ungu-dark" x-data="{ open: false, profileOpen: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <img class="h-8 w-auto" src="/img/logo/logo-ym.svg" alt="Logo">
      </div>

      <!-- Search Bar - Hidden on mobile -->
      <div class="hidden md:block flex-1 mx-4">
        <div class="relative">
          <input type="text"
            class="w-full px-4 py-2 rounded-lg bg-gray-100 text-ungu-dark placeholder-purple-300 focus:outline-none"
            placeholder="Search...">
          <button class="absolute right-0 top-0 mt-2 mr-4">
            <i class="fas fa-search text-purple-300"></i>
          </button>
        </div>
      </div>

      <!-- Desktop Navigation -->
      <div class="hidden md:flex items-center space-x-4">
        <!-- Notification Bell -->
        <button class="relative text-white">
          <i class="fas fa-bell text-xl"></i>
          <span
            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">3</span>
        </button>

        <!-- Shopping Cart -->
        <button class="relative text-white">
          <i class="fas fa-shopping-cart text-xl"></i>
          <span
            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">2</span>
        </button>

        <!-- Profile Dropdown -->
        <div class="relative" x-data="{ open: false }">
          <button @click="open = !open" class="flex items-center space-x-3 text-white">
            <img class="h-8 w-8 rounded-full" src="https://via.placeholder.com/32" alt="Profile">
            <span>John Doe</span>
            <i class="fas fa-chevron-down"></i>
          </button>
          <div x-show="open" @click.away="open = false"
            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
            <a href="{{ route('profile-user', auth()->user()->name) }}" wire:navigate
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
            <a href="{{ route('myOrder-user') }}" wire:navigate
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pesanan Saya</a>
            <a wire:click="logout"
              class="cursor-pointer block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
          </div>
        </div>
      </div>

      <!-- Mobile menu button -->
      <div class="md:hidden">
        <button @click="open = !open" class="text-white">
          <i class="fas fa-bars text-xl"></i>
        </button>
      </div>
    </div>

    <!-- Categories - Hidden on mobile -->
    <div class="hidden md:block border-t border-purple-800">
      <div class="flex space-x-2 py-3">
        @foreach ($categories as $category)
        <a href="{{ route('detail-category-user', $category->slug) }}" wire:navigate
          class="text-white w-full text-xs  hover:text-purple-200">{{
          $category->name }}</a>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Mobile menu -->
  <div x-show="open" class="md:hidden bg-purple-900">
    <!-- Mobile Search -->
    <div class="px-4 py-3">
      <div class="relative">
        <input type="text"
          class="w-full px-4 py-2 rounded-lg bg-purple-800 text-white placeholder-purple-300 focus:outline-none"
          placeholder="Search...">
        <button class="absolute right-0 top-0 mt-2 mr-8">
          <i class="fas fa-search text-purple-300"></i>
        </button>
      </div>
    </div>

    <!-- Mobile Categories -->
    <div class="px-4 py-3">
      <div class="font-medium text-white">Categories</div>
      <div class="mt-2 space-y-2">
        @foreach ($categories as $category)
        <a href="{{ route('detail-category-user', $category->slug) }}" wire:navigate class="block text-purple-200">{{
          $category->name
          }}</a>
        @endforeach
      </div>
    </div>

    <!-- Mobile Navigation Items -->
    <div class="px-4 pt-4 pb-3 border-t border-purple-800">
      <div class="flex items-center">
        <img class="h-8 w-8 rounded-full" src="https://via.placeholder.com/32" alt="Profile">
        <div class="ml-3">
          <div class="text-white">John Doe</div>
          <div class="text-purple-300 text-sm">john@example.com</div>
        </div>
      </div>
      <div class="mt-3 space-y-1">
        <a href="{{ route('profile-user', auth()->user()->name) }}" wire:navigate
          class="block px-3 py-2 text-white hover:text-purple-200">Profile</a>
        <a href="{{ route('myOrder-user') }}" wire:navigate
          class="block px-3 py-2 text-white hover:text-purple-200">Pesanan Saya</a>
        <a href="#" class="block px-3 py-2 text-white hover:text-purple-200">Notifications</a>
        <a href="#" class="block px-3 py-2 text-white hover:text-purple-200">Cart</a>
        <a wire:click="logout" class="cursor-pointer block px-3 py-2 text-white hover:text-purple-200">Logout</a>
      </div>
    </div>
  </div>
</nav>