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

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="relative min-h-screen">
        <!-- Login form overlay -->
        <div class="absolute inset-0 flex items-center justify-center z-10">
            <div class="bg-white rounded-3xl shadow-xl flex overflow-hidden">
                <!-- Right side with login form -->
                <div class="w-full p-8">
                    <a href="/" wire:navigate class="mb-4">
                        <img src="/img/logo/logo-ym-ungu.svg" alt="Logo" class="w-1/2 h-auto mb-4">
                    </a>
                    <h2 class="text-2xl font-bold mb-6">Welcome to Yayah Make Up</h2>
                    <h1 class="text-4xl font-bold mb-8">Sign in</h1>
                    <form wire:submit="login">
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

                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" wire:navigate
                                class="text-sm mt-4 text-ungu-dark hover:underline float-right">Forgot
                                Password</a>
                            @endif

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
                    <!-- New "Back to Home" button -->
                    <div class="mt-4 text-center">
                        <a href="/" wire:navigate
                            class="inline-block bg-gray-200 text-ungu-dark py-2 px-4 rounded-md hover:bg-gray-300 transition duration-300">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background images -->
        <div class="flex justify-between items-center min-h-screen">
            <div class="bg-ungu-dark justify-center flex min-h-screen w-1/2">
                <img src="/img/logo/login-1.svg" alt="Background 1">
            </div>
            <div class="bg-white justify-center flex min-h-screen w-1/2">
                <img src="/img/logo/login-2.svg" alt="Background 2">
            </div>
        </div>
    </div>
</div>