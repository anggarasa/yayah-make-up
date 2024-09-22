<a {{ $attributes }}
    class="flex items-center p-2 text-base font-medium rounded-lg hover:text-ungu-dark hover:bg-purple-100 group {{ $active ? 'text-ungu-dark bg-purple-100' : 'text-gray-900'}}">
    {{ $slot }}
</a>