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
    public string $phone_number = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email:rfc,dns,strict', 'max:255', 'unique:'.User::class],
            'phone_number' => ['required', 'string', 'min:10', 'max:13', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    protected $messages = [
        'name.required' => 'Nama wajib di isi.',
        'email.required' => 'Email wajib di isi.',
        'email.email' => 'Alamat email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'email.lowercase' => 'Email harus berupa huruf kecil.',
        'phone_number.required' => 'Nomor telepon wajib di isi.',
        'phone_number.min' => 'Nomor telepon minimal 10 - 12 karakter.',
        'phone_number.max' => 'Nomor telepon maksimal 13 karakter.',
        'phone_number.unique' => 'Nomor telepon sudah digunakan.',
        'password.required' => 'Password wajib di isi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
    ];
}; ?>

<div>
    <div class="relative min-h-screen">
        <!-- Login form overlay -->
        <div class="absolute inset-0 flex items-center justify-center z-10 p-4">
            <div class="bg-white shadow-lg rounded-lg flex flex-col md:flex-row max-w-4xl w-full">
                <!-- Logo section -->
                <div
                    class="w-full md:w-1/2 bg-white p-6 md:p-10 flex flex-col justify-center items-center rounded-t-lg md:rounded-l-lg md:rounded-tr-none">
                    <img src="/img/logo/login-2.svg" class="w-full max-w-xs h-auto" alt="Logo">
                </div>
                <!-- Form section -->
                <div class="w-full md:w-1/2 p-6 md:px-10 md:py-6">
                    <!-- Tombol Kembali -->
                    <a href="/" wire:navigate class="inline-block mb-4 font-poppins text-ungu-dark hover:underline">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Home
                    </a>

                    <h2 class="text-xl md:text-2xl font-bold mb-2">Sign Up</h2>
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
                                type="tel" required autocomplete="tel" />
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
                            <x-input-label for="password_confirmation">Konfirmasi Password<span
                                    class="text-red-600">*</span>
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
                                class="text-ungu-dark hover:underline">Sign in</a></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background images -->
        <div class="hidden md:flex justify-between items-center min-h-screen">
            <div class="bg-ungu-dark justify-center flex min-h-screen w-1/2">
            </div>
            <div class="bg-ungu-tipis justify-center flex min-h-screen w-1/2">
            </div>
        </div>
    </div>
</div>