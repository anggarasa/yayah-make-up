@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-black focus:border-ungu-dark
focus:ring-ungu-dark rounded-md shadow-sm']) !!}>