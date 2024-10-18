<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10" x-data="{ 
  scrollAmount: 0,
  slideWidth: 0,
  init() {
      this.slideWidth = this.$refs.firstSlide.offsetWidth;
      
      window.addEventListener('resize', () => {
          if (window.innerWidth < 640) {
              this.scrollAmount = 0;
              this.$refs.slider.style.transform = 'translateX(0)';
          }
          this.slideWidth = this.$refs.firstSlide.offsetWidth;
      });
  },
  prev() {
      this.scrollAmount = Math.max(this.scrollAmount - this.slideWidth, 0);
      this.$refs.slider.style.transform = `translateX(-${this.scrollAmount}px)`;
  },
  next() {
      this.scrollAmount = Math.min(
          this.scrollAmount + this.slideWidth,
          this.$refs.slider.scrollWidth - this.$refs.slider.clientWidth
      );
      this.$refs.slider.style.transform = `translateX(-${this.scrollAmount}px)`;
  }
}">
  <h1 class="text-2xl font-semibold text-ungu-dark capitalize lg:text-3xl dark:text-white mb-6">
    Wedding Gallery
  </h1>

  <div class="flex justify-end mb-6">
    <a href="{{ route('welcome-gallery') }}" wire:navigate
      class="py-2 px-6 sm:px-8 text-white bg-ungu-dark hover:bg-ungu-white transition-colors duration-300 rounded-lg text-sm sm:text-base">
      Lihat Semua...
    </a>
  </div>

  <div data-aos="fade-up" data-aos-anchor-placement="center-bottom" data-aos-duration="1000"
    class="relative w-full overflow-hidden">
    <div class="flex items-center justify-center w-full h-full py-4 sm:py-8">
      <button aria-label="slide backward" @click="prev"
        class="absolute z-30 left-0 ml-2 sm:ml-4 bg-ungu-dark hover:bg-ungu-white transition-colors duration-200 py-1 px-3 sm:px-3 rounded-full cursor-pointer focus:outline-none">
        <i class="fa-solid fa-angle-left text-lg sm:text-2xl text-white"></i>
      </button>
      <div class="w-full h-full mx-auto overflow-x-hidden overflow-y-hidden">
        <div x-ref="slider" class="h-full flex gap-4 items-center justify-start transition ease-out duration-700">
          <div x-ref="firstSlide" class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-1.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-2.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-3.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-4.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-5.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-6.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-7.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-8.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-9.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <!-- Repeat the above block for each image, updating the src, alt, and text content -->
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-10.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-11.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <div class="flex flex-shrink-0 relative w-64 sm:w-80 h-48 sm:h-64">
            <img src="/img/component/wedding/componen-wedding-12.jpg" alt="Wedding Image 1"
              class="object-cover object-center w-full h-full rounded-lg" />
            <div class="absolute inset-0 bg-gray-800 bg-opacity-30 p-4 rounded-lg">
              <h2 class="text-sm sm:text-base leading-tight text-white">Catalog 1</h2>
              <div class="absolute bottom-4 left-4">
                <h3 class="text-base sm:text-lg font-semibold leading-tight text-white">
                  Elegant Ceremony
                </h3>
              </div>
            </div>
          </div>
          <!-- Additional slides would go here -->
        </div>
      </div>
      <button aria-label="slide forward" @click="next"
        class="absolute z-30 right-0 mr-2 sm:mr-4 bg-ungu-dark hover:bg-ungu-white transition-colors duration-200 py-1 px-3 sm:px-3 rounded-full cursor-pointer focus:outline-none">
        <i class="fa-solid fa-angle-right text-lg sm:text-2xl text-white"></i>
      </button>
    </div>
  </div>
</div>