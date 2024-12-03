<?php

namespace App\Livewire\Layout\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

class AdminNavbar extends Component
{
    public $notifications;

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $admin = Auth::guard('admin')->user();
        $this->notifications = $admin->unreadNotifications()->take(4)->get();
    }

    public function markAsRead($notificationId)
    {
        $admin = Auth::guard('admin')->user();
        $notification = $admin->notifications()->find($notificationId);

        if ($notification) {
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
        return view('livewire.layout.admin.admin-navbar');
    }
}