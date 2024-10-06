{{-- Modal Success Start --}}
<div x-data="{ open: false }" x-show="open" @dress-success.window="open = true; setTimeout(() => open = false, 3000)"
  @close-dress-success.window="open = false" x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
  x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
  x-transition:leave-end="opacity-0 transform scale-90"
  class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
  <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="mt-3 text-center">
      <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
        <i class="fa-solid fa-check text-green-600"></i>
      </div>
      <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">{{ $judul }}</h3>
      <div class="mt-2 px-7 py-3">
        <p class="text-sm text-gray-500">
          {{ $message }}
        </p>
      </div>
      <div class="items-center px-4 py-3">
        <button @click="open = false"
          class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
          OK
        </button>
      </div>
    </div>
  </div>
</div>
{{-- Modal Success End --}}

{{-- Modal Error Start --}}
<div x-data="{ open: false }" x-show="open" @dress-error.window="open = true" @close-dress-error.window="open = false"
  x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
  x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
  x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
  class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
  <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="mt-3 text-center">
      <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
        <i class="fa-solid fa-x text-red-600"></i>
      </div>
      <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">{{ $judul }}</h3>
      <div class="mt-2 px-7 py-3">
        <p class="text-sm text-gray-500">
          {{ $message }}
        </p>
      </div>
      <div class="items-center px-4 py-3">
        <button @click="open = false"
          class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
          OK
        </button>
      </div>
    </div>
  </div>
</div>
{{-- Modal Error End --}}

{{-- Modal Konfirmasi Delete Start --}}
<div x-data="{ open: false }" x-show="open" @modal-confirm-delete.window="open = true"
  @close-modal-confirm-delete.window="open = false" x-transition:enter="transition ease-out duration-300"
  x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
  x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
  x-transition:leave-end="opacity-0 transform scale-90"
  class="fixed inset-0 bg-gray-600 z-50 bg-opacity-50 overflow-y-auto h-full w-full" style="display: none;">
  <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="mt-3 text-center">
      <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100">
        <i class="fa-solid fa-exclamation text-blue-600"></i>
      </div>
      <h3 class="text-lg leading-6 font-medium text-gray-900 mt-4">{{ $judul }}</h3>
      <div class="mt-2 px-7 py-3">
        <p class="text-sm text-gray-500">
          {{ $message }}
        </p>
      </div>

      <div class="mt-2">
        <img src="{{ asset('storage/file-dress/'. $image_dress) }}" alt="Image Delete"
          class="w-36 h-auto object-cover rounded-xl mx-auto">
        <p class="text-lg mt-2 text-black">"{{ $name }}"</p>
      </div>
      <div class="flex justify-between items-center px-4 py-3 gap-10">
        <button wire:click="deleteDress"
          class="px-2 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
          OK
        </button>
        <button type="button" wire:click="resetInput"
          class="px-2 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
          Batal
        </button>
      </div>
    </div>
  </div>
</div>
{{-- Modal Konfirmasi Delete End --}}