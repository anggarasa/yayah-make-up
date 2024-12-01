<div>
  <nav class="bg-ungu-dark fixed w-full z-30" x-data="{ open: false, profileOpen: false }">
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
          <div class="relative" x-data="{ open: false }">
            <button class="relative text-white" @click="open = !open">
              <i class="fas fa-bell text-xl"></i>
              @if ($notifications->count() > 0)
              <span
                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">{{
                $notifications->count() }}</span>
              @endif
            </button>

            <!-- Dropdown Notifications -->
            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100"
              x-transition:leave-end="opacity-0 scale-95"
              class="absolute right-0 mt-3 w-96 bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-100 dark:border-gray-700">

              <div class="p-4">
                <div class="flex items-center justify-between mb-4">
                  <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Notifications</h3>
                  @if($notifications->count() > 0)
                  <span
                    class="px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300 rounded-full">
                    {{ $notifications->count() }}
                  </span>
                  @endif
                </div>

                @if($notifications->count() > 0)
                <ul class="space-y-3">
                  @foreach ($notifications as $notification)
                  <li class="transform transition-all duration-200 hover:bg-gray-50 p-3 rounded-lg">
                    <div class="flex items-center justify-between">
                      <div class="flex items-center space-x-3">
                        @if ($notification->data['type_notification'] === 'status_order_diproses')
                        <div class="flex-shrink-0">
                          <img class="w-11 h-11 rounded-full"
                            src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                            alt="Bonnie Green avatar" />
                          <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-blue-700">
                            <i class="fas fa-spinner text-white text-xs"></i>
                          </div>
                        </div>
                        @elseif ($notification->data['type_notification'] === 'status_order_dikirim')
                        <div class="flex-shrink-0">
                          <img class="w-11 h-11 rounded-full"
                            src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                            alt="Bonnie Green avatar" />
                          <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-purple-700">
                            <i class="fas fa-truck text-white text-xs"></i>
                          </div>
                        </div>
                        @elseif ($notification->data['type_notification'] === 'status_order_selesai')
                        <div class="flex-shrink-0">
                          <img class="w-11 h-11 rounded-full"
                            src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                            alt="Bonnie Green avatar" />
                          <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-green-700">
                            <i class="fas fa-check-circle text-white text-xs"></i>
                          </div>
                        </div>
                        @endif
                        <div>
                          <a href="{{ route('order.show-order', $notification->data['order_id']) }}" wire:navigate
                            wire:click="markAsRead('{{ $notification->id }}')"
                            class="text-sm text-gray-700 hover:underline">
                            {{ $notification->data['message'] }}
                          </a> <br>
                          <span class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $notification->created_at->diffForHumans() }}
                          </span>
                        </div>
                      </div>
                      <button wire:click="markAsRead('{{ $notification->id }}')"
                        class="px-3 py-1 text-xs font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-200">
                        Mark as read
                      </button>
                    </div>
                  </li>
                  @endforeach
                </ul>

                <div class="mt-4">
                  <a href="{{ route('admin-notification') }}" class="text-sm text-blue-600 hover:underline">Lihat
                    Semua</a>
                </div>
                @else
                <div class="flex flex-col items-center justify-center py-6">
                  <div
                    class="w-16 h-16 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 mb-3">
                    <i class="fa-regular fa-bell text-gray-500 dark:text-gray-400 text-xl"></i>
                  </div>
                  <p class="text-gray-500 dark:text-gray-400 text-sm">No new notifications</p>
                </div>
                @endif
              </div>
            </div>
          </div>

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

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const userId = @json(auth()->id());
          // Inisialisasi Echo di sini
          window.Echo.private(`notification_user.${userId}`)
              .listen('.new-notification', (e) => {
                console.log("user notification: " + e);
                  @this.refreshNotifications();
              });
      });
  </script>
</div>