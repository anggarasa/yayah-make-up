<select {{ $attributes->merge(['class' => "shadow appearance-none border border-black rounded w-full py-2 px-3
    text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:ring-ungu-dark
    focus:border-ungu-dark"])}}>
    {{ $slot }}
</select>