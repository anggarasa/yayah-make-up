<button {{ $attributes->merge(['type' => 'button', 'class' => 'px-4 py-2 bg-ungu-dark hover:bg-ungu-white rounded-lg
    text-white'])
    }}>
    {{ $slot }}
</button>