<div x-show="open" x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
  x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
  x-transition:leave-end="opacity-0 transform scale-90"
  class="fixed inset-0 bg-gray-600 z-50 bg-opacity-60 flex items-center justify-center">
  <div class="bg-white rounded-lg shadow-xl max-w-3xl max-h-[90vh] w-full overflow-y-auto">
    <div class="px-6 py-4 border-b">
      <h2 class="text-xl font-bold text-center">Pilih Baju</h2>
    </div>

    <div class="px-6 py-4">
      <div>
        <h3 class="text-lg font-semibold mb-4">Baju Akad</h3>
        <div class="grid grid-cols-4 gap-4">
          @foreach ($bajus->where('dress_type', 'Akad') as $baju)
          <label for="dress_akad{{ $baju->id }}"
            class="bg-ungu-dark hover:bg-ungu-white cursor-pointer transition-colors duration-300 p-3 rounded-lg flex flex-col items-center shadow">
            <img src="{{ asset('storage/file-dress/'. $baju->image_dress) }}" alt="Placeholder"
              class="mb-2 w-40 h-52 object-cover">
            <p class="font-bold text-center text-white">{{ $baju->name }}</p>
            <input type="checkbox" wire:model="dress_akad" value="{{ $baju->id }}" id="dress_akad{{ $baju->id }}"
              class="mt-2" @checked(in_array($baju->id, $dress_akad))>
          </label>
          @endforeach
        </div>
      </div>

      <div class="mt-6">
        <h3 class="text-lg font-semibold mb-4">Baju Resepsi</h3>
        <div class="grid grid-cols-4 gap-4">
          @foreach ($bajus->where('dress_type', 'Resepsi') as $baju)
          <label for="dress_resepsi{{ $baju->id }}"
            class="bg-ungu-dark hover:bg-ungu-white cursor-pointer transition-colors duration-300 p-3 rounded-lg flex flex-col items-center shadow">
            <img src="{{ asset('storage/file-dress/'. $baju->image_dress) }}" alt="Placeholder"
              class="mb-2 w-40 h-52 object-cover">
            <p class="font-bold text-center text-white">{{ $baju->name }}</p>
            <input type="checkbox" wire:model="dress_resepsi" value="{{ $baju->id }}" id="dress_resepsi{{ $baju->id }}"
              class="mt-2" @checked(in_array($baju->id, $dress_resepsi))>
          </label>
          @endforeach
        </div>
      </div>
    </div>

    <div class="px-6 py-4 bg-gray-100 text-center border-t">
      <button @click="open = false" type="button"
        class="bg-ungu-dark text-white px-4 py-2 rounded shadow hover:bg-ungu-white transition">
        Selesai
      </button>
    </div>
  </div>
</div>