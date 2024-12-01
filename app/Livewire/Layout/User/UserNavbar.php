<?php

namespace App\Livewire\Layout\User;

use Livewire\Component;
use App\Models\CategoryProduct;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

class UserNavbar extends Component
{
  public $categories;
  public $notifications;

  public function mount()
  {
    $this->categories = CategoryProduct::all();
    $this->loadNotifications();
  }

  public function loadNotifications()
  {
      $user = Auth::user();
      $this->notifications = $user->unreadNotifications()->take(4)->get();
  }

    public function markAsRead($notificationId)
    {
        // Dapatkan pengguna yang terautentikasi
        $user = Auth::user();

        // Temukan notifikasi berdasarkan ID
        $notification = $user->notifications()->find($notificationId);

        if ($notification) {
            // Tandai notifikasi sebagai dibaca
            $notification->markAsRead();
        }

        // Segarkan notifikasi
        $this->loadNotifications();
    }

    // New method to refresh notifications
    public function refreshNotifications()
    {
        $this->loadNotifications();
    }
  
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/');
    }
  
  public function render()
  {
    return view('livewire.layout.user.user-navbar');
  }
}