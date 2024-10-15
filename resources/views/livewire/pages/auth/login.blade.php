<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('user-home', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="relative min-h-screen">
        <!-- Login form overlay -->
        <div class="absolute inset-0 flex items-center justify-center z-10">
            <div data-aos="zoom-in" data-aos-duration="2000"
                class="bg-white rounded-3xl shadow-xl flex overflow-hidden">

                <!-- Right side with login form -->
                <div class="w-full p-8">
                    <a href="/" wire:navigate class="mb-4">
                        <img src="/img/logo/logo-ym-ungu.svg" alt="Logo" class="w-1/2 h-auto mb-4">
                    </a>
                    <h2 class="text-2xl font-bold mb-6">Welcome to Yayah Make Up</h2>
                    <h1 class="text-4xl font-bold mb-8">Sign in</h1>
                    <form>
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Masukan Email Anda')" />
                            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email"
                                name="email" required autofocus autocomplete="username"
                                placeholder="youremail@example.com" />
                            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                        </div>
                        <div class="mb-6">
                            <x-input-label for="password" :value="__('Masukan Password Anda')" />
                            <div x-data="{ showPassword: false }" class="relative">
                                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                                    x-bind:type="showPassword ? 'text' : 'password'" name="password"
                                    placeholder="Password" required autocomplete="current-password" />
                                <button type="button" x-on:click="showPassword = !showPassword"
                                    class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-ungu-dark">
                                    <i x-bind:class="{
                                            'fa-regular fa-eye-slash': !showPassword,
                                            'fa-regular fa-eye': showPassword
                                        }" class="text-sm"></i>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />

                            <a href="#" class="text-sm mt-4 text-ungu-dark hover:underline float-right">Forgot
                                Password</a>

                            <label for="remember" class="inline-flex items-center mt-4">
                                <input wire:model="form.remember" id="remember" type="checkbox"
                                    class="rounded border-gray-300 text-ungu-dark shadow-sm focus:ring-ungu-dark"
                                    name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <button type="submit"
                            class="w-full bg-ungu-dark text-white py-2 px-4 rounded-md hover:bg-ungu-white transition duration-300">Sign
                            in</button>
                    </form>
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">No Account? <a href="{{ route('register') }}" wire:navigate
                                class="text-ungu-dark hover:underline">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background images -->
        <div class="flex justify-between items-center min-h-screen">
            <div class="bg-ungu-dark justify-center flex min-h-screen w-1/2">
                <img data-aos="fade-up" data-aos-duration="2000" src="/img/logo/login-1.svg" alt="Background 1">
            </div>
            <div class="bg-white justify-center flex min-h-screen w-1/2">
                <img data-aos="fade-down" data-aos-duration="2000" src="/img/logo/login-2.svg" alt="Background 2">
            </div>
        </div>
    </div>

    {{-- <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}" wire:navigate>
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}
</div>