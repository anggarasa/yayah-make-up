<?php

namespace App\Livewire\Pages\Welcome;

use App\Mail\ContactWelcomeMail;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactWelcome extends Component
{
    public $name, $email, $message;

    public $judul, $pesan;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email:dns,rfc',
        'message' => 'required|min:10'
    ];

    public function submit()
    {
        try {
            $this->validate();

            Mail::to('anggarasaputra273@gmail.com')->send(new ContactWelcomeMail($this->name, $this->email, $this->message));

            $this->reset(['name', 'email', 'message']);

            $this->judul = "Success!";
            $this->pesan = "Terimakasih atas pesan Anda. Kami akan segera menghubungi Anda.";
            $this->dispatch('contact-success');
        } catch (\Exception $e) {
            $this->judul = "Error!";
            $this->pesan = $e->getMessage();
            $this->dispatch('contact-error');
        }
    }
    
    public function render()
    {
        return view('livewire.pages.welcome.contact-welcome');
    }
}
