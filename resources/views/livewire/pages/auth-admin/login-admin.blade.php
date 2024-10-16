<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="bg-ungu-linear-bawah flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-3xl shadow-xl flex max-w-4xl w-full overflow-hidden">
            <!-- Left side with bride and groom illustration -->
            <div class="hidden md:block w-1/2 bg-white p-8">
                <div class="h-full flex items-center justify-center">
                    <img src="/img/logo/login.png" alt="">
                </div>
            </div>

            <!-- Right side with login form -->
            <div class="w-full md:w-1/2 p-8">
                <a href="/" wire:navigate class="mb-4">
                    <img src="/img/logo/logo-ym-ungu.svg" alt="Logo" class="w-1/2 h-auto mb-4">
                </a>
                <h1 class="text-4xl font-bold mb-4">Sign in</h1>
                <h2 class="text-xl font-bold mb-8">Selamat Datang di Yayah Make Up</h2>
                <form wire:submit="loginAdmin">
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Masukan Email Anda')" />
                        <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email"
                            required autofocus placeholder="youremail@example.com" autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" />
                        <div x-data="{ showPassword: false }" class="relative">
                            <x-text-input wire:model="password" id="password"
                                x-bind:type="showPassword ? 'text' : 'password'" class="block mt-1 w-full"
                                type="password" name="password" placeholder="Password" required
                                autocomplete="current-password" />
                            <button type="button" x-on:click="showPassword = !showPassword"
                                class="absolute inset-y-0 end-0 flex items-center z-20 px-3 cursor-pointer text-gray-400 rounded-e-md focus:outline-none focus:text-ungu-dark">
                                <i x-bind:class="{
                                    'fa-regular fa-eye-slash': !showPassword,
                                    'fa-regular fa-eye': showPassword
                                }" class="text-sm"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        {{-- Forgot Password Start --}}
                        <a href="#" class="text-sm text-ungu-dark hover:underline float-right mt-4">Forgot Password</a>
                        {{-- Forgot Password End --}}

                        {{-- Remember me Start --}}
                        <label for="remember" class="inline-flex mt-4 items-center">
                            <input wire:model="remember" id="remember" type="checkbox"
                                class="rounded border-gray-300 text-ungu-dark shadow-sm focus:ring-ungu-dark"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                        {{-- Remember me End --}}
                    </div>
                    <button type="submit"
                        class="w-full bg-ungu-dark text-white py-2 px-4 rounded-md hover:bg-ungu-white transition duration-300">Sign
                        in</button>
                </form>
            </div>
        </div>
    </div>

    {{-- <form wire:submit="loginAdmin">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="remember" id="remember" type="checkbox"
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