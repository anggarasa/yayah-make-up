<?php

namespace App\Livewire\Pages\Admin\Question;

use App\Livewire\Layout\Admin\Sidebar;
use App\Mail\ContactWelcomeMail;
use App\Models\QuestionWelcome;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin-layout')]
class ShowQuestionWelcome extends Component
{
    public QuestionWelcome $question;
    public $answer;

    public $judul, $pesan;

    public function mount(QuestionWelcome $question)
    {
        $this->question = $question;
    }

    public function submitAnswer()
    {
        try {
            $this->validate([
                'answer' => 'required|min:10'
            ]);

            $this->question->update([
                'answer' => $this->answer,
                'is_answer' => true
            ]);

            Mail::to($this->question->email)->send(new ContactWelcomeMail($this->question));

            $this->judul = 'Success!';
            $this->pesan = 'Jawaban berhasil dikirim kepada pengguna.';
            $this->dispatch('contact-success');
        } catch (\Exception $e) {
            $this->judul = 'Error!';
            $this->pesan = $e->getMessage();
            $this->dispatch('contact-error');
        }
    }
    public function render()
    {
        return view('livewire.pages.admin.question.show-question-welcome');
    }
}
