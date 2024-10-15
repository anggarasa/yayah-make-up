<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="relative min-h-screen">
        <!-- Login form overlay -->
        <div class="absolute inset-0 flex items-center justify-center z-10">
            <div class="bg-white shadow-lg rounded-lg flex max-w-4xl w-full">
                <div class="w-1/2 bg-white p-10 flex flex-col justify-center items-center rounded-l-lg">
                    <img src="/img/logo/login-2.svg" class="w-full h-auto" alt="Logo">
                </div>
                <div class="w-1/2 p-10">
                    <h2 class="text-2xl font-bold mb-2">Sign Up</h2>
                    <p class="text-gray-600 mb-6">Selamat datang! Silakan buat akun anda.</p>
                    <form wire:submit="register">
                        <div class="mb-4">
                            <x-input-label for="name">
                                Nama Lengkap<span class="text-red-600">*</span>
                            </x-input-label>
                            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name"
                                required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email">
                                Alamat Email<span class="text-red-600">*</span>
                            </x-input-label>
                            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email"
                                name="email" required autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="phone_number">
                                Nomor Hp/Wa<span class="text-red-600">*</span>
                            </x-input-label>
                            <x-text-input wire:model="phone_number" id="phone_number" class="block mt-1 w-full"
                                type="number" name="email" required autocomplete="tel" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="password">Password<span class="text-red-600">*</span></x-input-label>

                            <div x-data="{ showPassword: false }" class="relative">
                                <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                    x-bind:type="showPassword ? 'text' : 'password'" type="password" name="password"
                                    required autocomplete="new-password" />

                                <button type="button" x-on:click="showPassword = !showPassword"
                                    class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-ungu-dark">
                                    <i x-bind:class="{
                                            'fa-regular fa-eye-slash': !showPassword,
                                            'fa-regular fa-eye': showPassword
                                        }" class="text-sm"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="password">Konfirmasi Password<span class="text-red-600">*</span>
                            </x-input-label>

                            <div x-data="{ showConfirmPassword: false }" class="relative">
                                <x-text-input wire:model="password_confirmation" id="password_confirmation"
                                    x-bind:type="showConfirmPassword ? 'text' : 'password'" class="block mt-1 w-full"
                                    type="password" name="password_confirmation" required autocomplete="new-password" />

                                <button type="button" x-on:click="showConfirmPassword = !showConfirmPassword"
                                    class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-ungu-dark">
                                    <i x-bind:class="{
                                            'fa-regular fa-eye-slash': !showConfirmPassword,
                                            'fa-regular fa-eye': showConfirmPassword
                                        }" class="text-sm"></i>
                                </button>
                            </div>

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <button
                                class="bg-ungu-dark hover:bg-ungu-white transition duration-300 text-white font-bold py-2 px-4 rounded w-full"
                                type="submit">
                                Sign Up
                            </button>
                        </div>
                    </form>
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" wire:navigate
                                wire:navigate class="text-ungu-dark hover:underline">Sign in</a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background images -->
        <div class="flex justify-between items-center min-h-screen">
            <div class="bg-ungu-dark justify-center flex min-h-screen w-1/2">
            </div>
            <div class="bg-ungu-tipis justify-center flex min-h-screen w-1/2">
            </div>
        </div>
    </div>

    {{-- <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form> --}}
</div>