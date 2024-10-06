<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-ungu-dark border
    border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-ungu-white
    focus:bg-ungu-white active:bg-ungu-dark focus:outline-none focus:ring-2 focus:ring-ungu-white focus:ring-offset-2
    transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>