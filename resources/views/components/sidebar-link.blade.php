<a {{ $attributes }}
    class="flex items-center p-2 text-base font-medium rounded-lg hover:text-white hover:bg-ungu-dark group {{ $active ? 'text-white bg-ungu-dark' : 'text-gray-900'}}">
    {{ $slot }}
</a>