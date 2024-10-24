<?php

namespace App\Livewire\Layout\Admin;

use App\Models\QuestionWelcome;
use Livewire\Attributes\On;
use Livewire\Component;

class Sidebar extends Component
{
  public $unreadCount = 0;
  public $judul, $pesan;
  
  public function mount()
  {
    $this->unreadCount = QuestionWelcome::where('is_read', false)->count();
  }

    // Method untuk menangani event baru
    #[On('echo:questions,QuestionMessageEvent')]
    public function handleNewQuestion($event)
    {
        $this->unreadCount = $event['count'];
    }
    
    public function render()
    {
        return view('livewire.layout.admin.sidebar');
    }
}
