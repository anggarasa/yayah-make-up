<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NotificationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $type;
    public $data;
    public $role;
    public $userId;

    /**
     * Create a new event instance.
     */
    public function __construct($message, $type, $data, $role, $userId = null)
    {
        // Log::info('NotificationEvent Constructor', [
        //     'message' => $message,
        //     'type' => $type,
        //     'role' => $role,
        //     'user_id' => $userId
        // ]);
        
        $this->message = $message;
        $this->type = $type;
        $this->data = $data;
        $this->role = $role;
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        // Log::info('Broadcast Channels', [
        //     'role' => $this->role,
        //     'user_id' => $this->userId,
        //     'channels' => $this->role == 'user' && $this->userId 
        //         ? ['pop-up_user.' . $this->userId, 'notification_user.' . $this->userId]
        //         : ['no_channels']
        // ]);

        if ($this->role == 'admin') {
            return [
                new Channel('pop-up_admin'),
                new Channel('notification_admin')
            ];
        } elseif ($this->role == 'user' && $this->userId) {
            return [
                new PrivateChannel('pop-up_user.' . $this->userId),
                new PrivateChannel('notification_user.' . $this->userId),
            ];
        }

        // Fallback atau return kosong jika tidak memenuhi kondisi
        return [];
    }

    public function broadcastAs()
    {
        return 'new-notification';
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->message,
            'type' => $this->type,
            'data' => $this->data,
            'role' => $this->role,
            'user_id' => $this->userId,
        ];
    }
}
