<?php

namespace App\Livewire\Notifications;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.admin-layout')]
class AdminNotification extends Component
{
    public $notifications;

    public function mount()
    {
        $this->loadMoreNotifications();
    }

    public function loadMoreNotifications()
    {
        // Ambil admin yang sedang login
        $admin = Auth::guard('admin')->user();

        // Ambil semua notifikasi untuk admin
        $this->notifications = $admin->notifications; // Mengambil semua notifikasi
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

    public function refreshNotifications()
    {
        $this->loadMoreNotifications();
    }

    public function render()
    {
        return view('livewire.notifications.admin-notification');
    }
}
