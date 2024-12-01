<div>
  <nav class="bg-ungu-dark border-b border-gray-200 px-10 py-2.5 fixed left-0 right-0 top-0 z-40">
    <div class="flex flex-wrap justify-between items-center">
      <div class="flex justify-start items-center">
        <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
          aria-controls="drawer-navigation"
          class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
          <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
              clip-rule="evenodd"></path>
          </svg>
          <svg aria-hidden="true" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
          <span class="sr-only">Toggle sidebar</span>
        </button>
        <a href="/" class="flex items-center justify-between mr-4">
          <img src="/img/logo/logo-ym.svg" class="mr-3 h-8" alt="Flowbite Logo" />
        </a>
      </div>
      <div class="flex items-center lg:order-2">
        <button type="button" data-drawer-toggle="drawer-navigation" aria-controls="drawer-navigation"
          class="p-2 mr-1 text-gray-500 rounded-lg md:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
          <span class="sr-only">Toggle search</span>
          <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path clip-rule="evenodd" fill-rule="evenodd"
              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
            </path>
          </svg>
        </button>

        <!-- Notifications -->
        <div class="relative" x-data="{ open: false }">
          <!-- Bell Icon -->
          <button @click="open = !open"
            class="py-2 px-3 mr-1 rounded-lg text-white hover:bg-ungu-white focus:bg-ungu-white">
            <span class="sr-only">View notifications</span>
            <!-- Bell icon -->
            <i class="fa-solid fa-bell"></i>
            @if($notifications->count() > 0)
            <span
              class="absolute top-0 right-0 w-4 h-4 bg-red-500 text-white text-xs font-bold flex items-center justify-center rounded-full">
              {{ $notifications->count() }}
            </span>
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
                      @if ($notification->data['type_notification'] === 'order_created')
                      <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                          src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                          alt="Bonnie Green avatar" />
                        <div
                          class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-green-700">
                          <i class="fa-solid fa-cart-shopping text-white text-xs"></i>
                        </div>
                      </div>
                      @elseif ($notification->data['type_notification'] === 'payment_success')
                      <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                          src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                          alt="Bonnie Green avatar" />
                        <div
                          class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-blue-700">
                          <i class="fa-solid fa-money-bill text-white text-xs"></i>
                        </div>
                      </div>
                      @elseif ($notification->data['type_notification'] === 'cancel_order')
                      <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                          src="{{ $notification->data['profile_image'] ?? asset('img/component/avatar.png') }}"
                          alt="Bonnie Green avatar" />
                        <div
                          class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-red-700">
                          <i class="fa-solid fa-xmark text-white text-xs"></i>
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
                <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 mb-3">
                  <i class="fa-regular fa-bell text-gray-500 dark:text-gray-400 text-xl"></i>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-sm">No new notifications</p>
              </div>
              @endif
            </div>
          </div>
        </div>

        <button type="button"
          class="flex mx-6 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300"
          id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
          <span class="sr-only">Open user menu</span>
          <img class="w-8 h-8 rounded-full"
            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png" alt="user photo" />
        </button>
        <!-- Dropdown menu -->
        <div class="hidden z-50 my-4 w-56 text-base list-none bg-white divide-y divide-gray-100 shadow rounded-xl"
          id="dropdown">
          <div class="py-3 px-4">
            <span class="block text-sm font-semibold text-gray-900">Neil Sims</span>
            <span class="block text-sm text-gray-900 truncate">name@flowbite.com</span>
          </div>
          <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
            <li>
              <a href="#"
                class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My
                profile</a>
            </li>
            <li>
              <a href="#"
                class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Account
                settings</a>
            </li>
          </ul>
          <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
            <li>
              <a href="#"
                class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                  class="mr-2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                    clip-rule="evenodd"></path>
                </svg>
                My likes</a>
            </li>
            <li>
              <a href="#"
                class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                  class="mr-2 w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                  </path>
                </svg>
                Collections</a>
            </li>
            <li>
              <a href="#"
                class="flex justify-between items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                <span class="flex items-center">
                  <svg aria-hidden="true" class="mr-2 w-5 h-5 text-blue-600 dark:text-blue-500" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                      d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                      clip-rule="evenodd"></path>
                  </svg>
                  Pro version
                </span>
                <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
                </svg>
              </a>
            </li>
          </ul>
          <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
            <li>
              <a wire:click="logout"
                class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign
                out</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi Echo di sini
        window.Echo.channel('notification_admin')
            .listen('.new-notification', (e) => {
                @this.refreshNotifications();
            });
    });
  </script>
</div>