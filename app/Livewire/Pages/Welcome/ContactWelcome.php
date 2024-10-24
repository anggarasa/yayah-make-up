<?php

namespace App\Livewire\Pages\Welcome;

use Livewire\Component;
use Livewire\Volt\Volt;
use App\Models\QuestionWelcome;
use App\Mail\ContactWelcomeMail;
use App\Events\NewQuestionReceived;
use App\Events\QuestionMessageEvent;
use Illuminate\Support\Facades\Mail;
use App\Livewire\Layout\Admin\Sidebar;

class ContactWelcome extends Component
{
    public $name, $email, $question;

    public $judul, $pesan;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email:dns,rfc',
        'question' => 'required|min:10'
    ];

    public function submit()
    {
        try {
            $this->validate();

            QuestionWelcome::create([
                'name' => $this->name,
                'email' => $this->email,
                'question' => $this->question,
                'is_read' => false,
            ]);
            
            $this->reset(['name', 'email', 'question']);

            $unreadCount = QuestionWelcome::where('is_read', false)->count();
            QuestionMessageEvent::dispatch($unreadCount);

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
