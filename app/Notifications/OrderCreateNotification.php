<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Events\NotificationEvent;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCreateNotification extends Notification
{
    use Queueable;

    public $type;
    public $data;
    
    /**
     * Create a new notification instance.
     */
    public function __construct($type, $data)
    {
        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toBroadcast(object $notifiable)
    {
        $message = $this->generateBroadcastMessage();
        
        // Trigger event real-time
        event(new NotificationEvent($message, $this->type, $this->data));

        return [
            'message' => $message,
            'type' => $this->type,
            'data' => $this->data
        ];
    }

    protected function generateBroadcastMessage()
    {
        switch ($this->type) {
            case 'order_created':
                return "{$this->data['customer_name']} telah membuat pesanan baru";
            
            case 'payment_success':
                return "{$this->data['customer_name']} sudah membayar pesanan";
            
            default:
                return "Notifikasi baru";
        }
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        if ($this->type == 'order_created') {
            return [
                'message' => $this->data['customer_name'] . ' telah membuat pesanan baru',
                'type_notification' => 'order_created',
                'order_id' => $this->data['order_id'],
                'product_name' => $this->data['product_name'],
                'customer_name' => $this->data['customer_name'],
                'total_harga' => $this->data['total_harga'],
                'profile_image' => $this->data['profile_image'],
                'created_at' => now(),
            ];
        } elseif ($this->type == 'payment_success') {
            return [
                'message' => $this->data['customer_name'] . ' sudah membayar pesanan yang dia pesan.',
                'type_notification' => 'payment_success',
                'order_id' => $this->data['order_id'],
                'product_name' => $this->data['product_name'],
                'customer_name' => $this->data['customer_name'],
                'status_payment' => $this->data['status_payment'],
                'payment_type' => $this->data['payment_type'],
                'total_harga' => $this->data['total_harga'],
                'profile_image' => $this->data['profile_image'],
            ];
        }

        // Default return untuk kasus yang tidak dikenali
        return [
            'message' => 'Notifikasi tidak dikenali.',
            'type_notification' => 'unknown',
        ];
    }
}
