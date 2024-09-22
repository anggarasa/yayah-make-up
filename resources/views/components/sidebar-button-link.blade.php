<button type="button"
    class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-purple-100"
    @click="open = !open" :aria-expanded="open.toString()" aria-controls="dropdown-pages">
    {{ $trigger }}
</button>

{{-- Dropdown --}}
<div x-show="open" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-y-4"
    x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0"
    x-transition:leave-end="opacity-0 transform -translate-y-4" class="overflow-hidden" style="display: none;">
    <ul id="dropdown-pages" class="py-2 space-y-2">
        {{ $content }}
    </ul>
</div>