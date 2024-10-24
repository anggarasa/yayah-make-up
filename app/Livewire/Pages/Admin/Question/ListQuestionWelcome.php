<?php

namespace App\Livewire\Pages\Admin\Question;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\QuestionWelcome;
use Livewire\Attributes\Layout;
use App\Events\NewQuestionReceived;
use Livewire\Features\SupportPagination\WithoutUrlPagination;

#[Layout('layouts.admin-layout')]
class ListQuestionWelcome extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $statusFilter = 'all';
    protected $queryString = ['statusFilter'];

    public function mount()
    {
        QuestionWelcome::where('is_read', false)->update(['is_read' => true]);
    }

    public function updatingStatusFilter() 
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $questions = QuestionWelcome::query()
            ->when($this->statusFilter === 'answered', function ($query) {
                return $query->where('is_answer', true);
            })
            ->when($this->statusFilter === 'unanswered', function ($query) {
                return $query->where('is_answer', false);
            })
            ->latest()
            ->paginate(10);
        return view('livewire.pages.admin.question.list-question-welcome', [
            'questions' => $questions,
            'answeredCount' => QuestionWelcome::where('is_answer', true)->count(),
            'unansweredCount' => QuestionWelcome::where('is_answer', false)->count(),
            'totalCount' => QuestionWelcome::count(),
        ]);
    }
}
