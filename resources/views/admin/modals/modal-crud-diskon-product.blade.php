<div x-show="open" x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
  x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
  x-transition:leave-end="opacity-0 transform scale-90" class="fixed inset-0 z-40 flex items-center justify-center">
  <div class="bg-white rounded-lg shadow-xl max-w-3xl max-h-[90vh] w-full overflow-y-auto">
    <div class="px-6 py-4 border-b">
      <h2 class="text-xl font-bold text-center">Select Product</h2>
    </div>

    <div class="px-6 pt-4 pb-10">
      <div>
        <div class="grid grid-cols-2 gap-4">
          @foreach ($products as $produk)
          <label for="produks_{{ $produk->id }}"
            class="bg-white cursor-pointer pb-2 transition-colors duration-300 rounded-lg flex flex-col items-center shadow">
            <img src="{{ asset('storage/'. $produk->cover_image) }}" alt="Placeholder"
              class="mb-2 w-full h-52 rounded-t-lg object-cover">
            <p class="font-bold text-center text-black">{{ $produk->title }}</p>
            <input type="checkbox" wire:model="produks" value="{{ $produk->id }}" id="produks_{{ $produk->id }}"
              @checked(in_array($produk->id, $produks)) class="mt-2 rounded bg-ungu-tipis text-ungu-dark
            border-ungu-dark focus:ring-ungu-dark">
          </label>
          @endforeach
        </div>
      </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 border-t sticky bottom-10 z-50">
      <div class="flex justify-center space-x-4">
        <button @click="open = false" type="button"
          class="bg-ungu-dark text-white px-4 py-2 rounded shadow hover:bg-ungu-white transition">
          Selesai
        </button>
      </div>
    </div>
  </div>
</div>