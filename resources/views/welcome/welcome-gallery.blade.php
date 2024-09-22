<x-welcome-layout>
  <div class="bg-ungu-linear-bawah">
    @include('welcome.sections.navbar-gallery')
    <div class="mx-auto">
      <div class="flex items-center justify-center">
        <div class="container mx-auto flex flex-col md:flex-row items-center justify-between">
          <div class="flex-1 flex justify-center">
            <div class="relative" data-aos="flip-down" data-aos-duration="2000">
              <img src="/img/component/gallery/componen-gallery-all.svg" class="w-full h-auto object-cover" alt="">
            </div>
          </div>

          <div data-aos="fade-left" data-aos-duration="2000"
            class="flex-1 text-center md:text-left text-white mt-8 md:mt-0">
            <h1 class="text-3xl font-bold">Tampil memukau di hari istimewa Anda</h1>
            <p class="mt-4 text-lg">dengan riasan pengantin yang sempurna, menonjolkan kecantikan alami Anda</p>
          </div>
        </div>
      </div>
    </div>
  </div>


  {{-- Weeding gallery start --}}
  <div class="container mx-auto px-20 py-10">
    <h1 class="text-2xl font-semibold text-ungu-dark capitalize lg:text-3xl dark:text-white">Wedding Gallery
    </h1>

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
        <div class="space-y-2">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1540575861501-7cf05a4b125a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1668906093328-99601a1aa584?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1567016526105-22da7c13161a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
        </div>
        <div class="space-y-2">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1668584054131-d5721c515211?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1664574654529-b60630f33fdb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
        </div>
        <div class="space-y-2">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1586232702178-f044c5f4d4b7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
        </div>
        <div class="space-y-2">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1668869713519-9bcbb0da7171?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1668584054035-f5ba7d426401?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
        </div>
      </div>
    </div>
  </div>
  {{-- wedding gallery end --}}



  {{-- Dekorasi gallery start --}}
  <div class="container mx-auto px-20 py-10">
    <h1 class="text-2xl font-semibold text-ungu-dark capitalize lg:text-3xl dark:text-white">Dekorasi
    </h1>

    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
        <div class="space-y-2">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1540575861501-7cf05a4b125a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1668906093328-99601a1aa584?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1567016526105-22da7c13161a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
        </div>
        <div class="space-y-2">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1668584054131-d5721c515211?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1664574654529-b60630f33fdb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
        </div>
        <div class="space-y-2">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1586232702178-f044c5f4d4b7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
        </div>
        <div class="space-y-2">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1668869713519-9bcbb0da7171?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
          <img class="w-full h-auto object-cover"
            src="https://images.unsplash.com/photo-1668584054035-f5ba7d426401?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80"
            alt="Gallery Masonry Image">
        </div>
      </div>
    </div>
  </div>
  {{-- Dekorasi gallery end --}}



  {{-- Video gallery start --}}
  <div class="container mx-auto px-20 py-10">
    <h1 class="text-2xl font-semibold text-ungu-dark capitalize lg:text-3xl dark:text-white">
      Video
    </h1>

    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center">
        <h1 class="mb-4 text-7xl tracking-tight font-extrabold lg:text-9xl text-ungu-dark">404
        </h1>
        <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl">Something's
          missing.</p>
        <p class="mb-4 text-lg font-light text-gray-500">Sorry, we can't find that page. You'll
          find lots to explore on the home page. </p>
        <a href="#"
          class="inline-flex text-white bg-ungu-dark hover:bg-ungu-white focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center my-4">Back
          to Homepage</a>
      </div>
    </div>
  </div>
  {{-- Video gallery end --}}
</x-welcome-layout>