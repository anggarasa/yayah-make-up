<?php

namespace App\Livewire\Pages\AuthAdmin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class LoginAdmin extends Component
{
    public $email;
    public $password;

    public function loginAdmin()
    {
        // Cek jika user sudah terlalu banyak mencoba login
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            $seconds = RateLimiter::availableIn($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => "Terlalu banyak percobaan login. Coba lagi dalam {$seconds} detik.",
            ]);
        }

        // Validasi input user
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Coba untuk autentikasi user
        if (!Auth::guard('admin')->attempt(['email' => $this->email, 'password' => $this->password])) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => 'Email atau password salah.',
            ]);
        }

        // Reset limit jika login berhasil
        RateLimiter::clear($this->throttleKey());

        // Redirect ke halaman admin setelah login berhasil
        $this->redirectIntended(default:route('dashboard-admin', absolute:false), navigate:true);
    }

    // Mendefinisikan throttle key berdasarkan email atau alamat IP
    public function throttleKey()
    {
        return strtolower($this->email) . '|' . request()->ip();
    }
    
    public function render()
    {
        return view('livewire.pages.auth-admin.login-admin');
    }
}
