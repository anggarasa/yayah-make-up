<a {{ $attributes }}
    class="flex items-center p-2 text-base font-medium rounded-lg hover:text-ungu-dark hover:bg-ungu-tipis group {{ $active ? 'text-ungu-dark bg-ungu-tipis' : 'text-gray-900'}}">
    {{ $slot }}
</a>