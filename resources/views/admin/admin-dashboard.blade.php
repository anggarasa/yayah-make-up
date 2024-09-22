<x-admin-layout>
  <div class="max-w-3xl my-10 lg:mb-14">

    <h2 class="text-ungu-dark font-semibold font-poppins text-2xl md:text-4xl md:leading-tight">Dashboard</h2>

    <ol class="flex mt-5 items-center whitespace-nowrap">
      <li class="inline-flex items-center">
        <a class="flex items-center text-sm text-ungu-dark hover:text-ungu-white focus:outline-none focus:text-ungu-dark"
          href="{{ route('dashboard-admin') }}">
          Dashboard
        </a>
        <ion-icon name="chevron-forward" class="shrink-0 mx-2 size-4 text-gray-400"></ion-icon>
      </li>
      <li class="inline-flex items-center">
        <p class="flex items-center text-sm text-gray-500 cursor-pointer">
          Home
        </p>
      </li>
    </ol>
  </div>

  <!-- Grid -->
  <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-3 sm:gap-6 mx-10">
    <!-- Card -->
    <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition"
      href="#">
      <div class="p-4 md:p-5">
        <div class="flex justify-between items-center gap-x-3">
          <div class="grow">
            <div class="flex items-center gap-x-3">
              <div class="py-4 px-6 rounded-lg bg-purple-300">
                <i class="fa-solid fa-calendar-check text-ungu-dark text-3xl"></i>
              </div>
              <div class="grow">
                <h3 class="group-hover:text-ungu-dark font-bold text-gray-800">
                  1024
                </h3>
                <span class="text-gray-400 group-hover:text-ungu-dark">New Order</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    <!-- End Card -->
    <!-- Card -->
    <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800"
      href="#">
      <div class="p-4 md:p-5">
        <div class="flex justify-between items-center gap-x-3">
          <div class="grow">
            <div class="flex items-center gap-x-3">
              <div class="py-4 px-6 rounded-lg bg-yellow-300">
                <i class="fa-solid fa-user-group text-yellow-600 text-3xl"></i>
              </div>
              <div class="grow">
                <h3 class="group-hover:text-yellow-600 font-bold text-gray-800">
                  2087
                </h3>
                <span class="text-gray-400 group-hover:text-yellow-600">Sig Up</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    <!-- End Card -->
    <!-- Card -->
    <a class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md focus:outline-none focus:shadow-md transition dark:bg-neutral-900 dark:border-neutral-800"
      href="#">
      <div class="p-4 md:p-5">
        <div class="flex justify-between items-center gap-x-3">
          <div class="grow">
            <div class="flex items-center gap-x-3">
              <div class="py-4 px-6 rounded-lg bg-orange-300">
                <i class="fa-solid fa-money-bill text-orange-600 text-3xl"></i>
              </div>
              <div class="grow">
                <h3 class="group-hover:text-orange-600 font-bold text-gray-800">
                  Rp. 10.000.000
                </h3>
                <span class="text-gray-400 group-hover:text-orange-600">Total Sales</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    <!-- End Card -->
  </div>
  <!-- End Grid -->
</x-admin-layout>