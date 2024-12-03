<?php

namespace App\Livewire\Pages\User;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.profile-user-layout')]
class UserNotification extends Component
{
    public $notifications;

    public function mount()
    {
        $this->loadMoreNotifications();
    }

    public function loadMoreNotifications()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil semua notifikasi untuk user
        $this->notifications = $user->notifications; // Mengambil semua notifikasi
    }

    public function groupNotificationsByDate($notifications)
    {
        $grouped = [];

        foreach ($notifications as $notification) {
            $date = \Carbon\Carbon::parse($notification->created_at);

            // Tentukan label berdasarkan tanggal
            if ($date->isToday()) {
                $label = 'Hari Ini';
            } elseif ($date->isYesterday()) {
                $label = 'Kemarin';
            } else {
                $label = $date->translatedFormat('d F Y'); // Format untuk tanggal lainnya
            }

            // Kelompokkan notifikasi berdasarkan label
            $grouped[$label][] = $notification;
        }

        return $grouped;
    }
    
    public function render()
    {
        return view('livewire.pages.user.user-notification');
    }
}
