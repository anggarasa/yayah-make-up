<?php

namespace App\Livewire\Layout\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\QuestionWelcome;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
  public $unreadCount = 0;
  public $notification;
  public $judul, $pesan;
  
  public function mount()
  {
    $this->unreadCount = QuestionWelcome::where('is_read', false)->count();
    $this->loadNotifications();
  }

  // menangani event notification baru
  public function loadNotifications()
  {
      $admin = Auth::guard('admin')->user();
      $this->notification = $admin->unreadNotifications()->get();
  }

    // Method untuk menangani event baru
    #[On('echo:questions,QuestionMessageEvent')]
    public function handleNewQuestion($event)
    {
        $this->unreadCount = $event['count'];
    }

    public function markAllAsRead()
    {
        $admin = Auth::guard('admin')->user();

        // Ambil semua notifikasi yang belum dibaca
        $unreadNotifications = $admin->notifications()->where('read_at', null)->get();

        // Tandai semua notifikasi yang belum dibaca sebagai dibaca
        foreach ($unreadNotifications as $notification) {
            $notification->markAsRead();
        }

        // Refresh notifications
        $this->loadNotifications();
    }

    // New method to refresh notifications
    public function refreshNotifications()
    {
        $this->loadNotifications();
    }
    
    public function render()
    {
        return view('livewire.layout.admin.sidebar');
    }
}
