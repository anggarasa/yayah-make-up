<?php

namespace App\Livewire\Layout\Admin\Notification;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin-layout')]
class PopupNotificationAdmin extends Component
{
    // Properti untuk menyimpan pesan
    public $messages = [];

    #[On('notificationAdmin')]
    public function notificationAdmin($params)
    {
        $id = now()->timestamp;
        
        $this->messages[] = [
            'id' => $id,
            'type' => $params['type'] ?? 'info',
            'message' => $params['message'] ?? '',
            'title' => $params['title'] ?? ''
        ];
    }
    
    public function removeNotification($id)
    {
        $this->messages = collect($this->messages)
            ->filter(function($notification) use ($id) {
                return $notification['id'] !== $id;
            })->toArray();
    }

    public function render()
    {
        return view('livewire.layout.admin.notification.popup-notification-admin');
    }
}
