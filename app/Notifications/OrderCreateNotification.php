<?php

namespace App\Notifications;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use App\Events\NotificationEvent;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class OrderCreateNotification extends Notification
{
    use Queueable;

    public $type;
    public $data;
    public $role;
    
    /**
     * Create a new notification instance.
     */
    public function __construct($type, $data, $role)
    {
        $this->type = $type;
        $this->data = $data;
        $this->role = $role;
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
        ->markdown('emails.order-notification-mail', [
            'order' => $this->data,
            'type' => $this->type
        ])
        ->subject('Notifikasi Pesanan Baru');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toBroadcast(object $notifiable)
    {
        $message = $this->generateBroadcastMessage();

        // Log::info('Notification Data:', [
        //     'type' => $this->type,
        //     'data' => $this->data,
        //     'role' => $this->role
        // ]);
        
        $userId = $this->data['user_id'] ?? null;

        // Log::info('Notification User ID Check', [
        //     'user_id' => $userId,
        //     'user_id_exists' => $userId !== null,
        //     'data_keys' => array_keys($this->data)
        // ]);
        
        // Trigger event real-time
        event(new NotificationEvent($message, $this->type, $this->data, $this->role, $userId));

        return [
            'message' => $message,
            'type' => $this->type,
            'data' => $this->data,
            'role' => $this->role,
            'user_id' => $userId,
        ];
    }

    protected function generateBroadcastMessage()
    {
        switch ($this->type) {
            case 'order_created':
                return "{$this->data['customer_name']} telah membuat pesanan baru";
            case 'payment_success':
                return "{$this->data['customer_name']} sudah membayar pesanan";
            case 'cancel_order':
                return "{$this->data['customer_name']} telah membatalkan pesanan ID: #". Str::limit($this->data['order_id'], 5, '...');
            case 'update_status_order':
                if ($this->data['status'] == 'diproses'){
                    return "Pesanan ID: #". Str::limit($this->data['order_id'], 5, '...') . " sedang diproses";
                } elseif ($this->data['status'] == 'dikirim') {
                    return "Pesanan ID: #" . Str::limit($this->data['order_id'], 5, '...') . " telah dikirim";
                } elseif ($this->data['status'] == 'selesai') {
                    return "Pesanan ID: #" . Str::limit($this->data['order_id'], 5, '...') . " telah selesai";
                }
            
            default:
                return "Notifikasi baru";
        }
    }

    /**
     * Get the database representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        // Notification Admin
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
                'created_at' => now(),
            ];
        } elseif ($this->type == 'cancel_order') {
            return [
                'message' => $this->data['customer_name']. " telah membatalkan pesanan ID: {$this->data['order_id']}",
                'type_notification' => 'cancel_order',
                'order_id' => $this->data['order_id'],
                'product_name' => $this->data['product_name'],
                'status_payment' => $this->data['status_payment'],
                'status' => $this->data['status'],
                'customer_name' => $this->data['customer_name'],
                'payment_type' => $this->data['payment_type'],
                'total_harga' => $this->data['total_harga'],
                'profile_image' => $this->data['profile_image'],
                'created_at' => now(),
            ];

            // Notification User
        } elseif ($this->type == 'update_status_order') {
            if ($this->data['status'] == 'diproses') {
                return [
                    'message' => "Pesanan #" . Str::limit($this->data['order_id'], 5, '...') . " telah di konfirmasi",
                    'type_notification' => 'status_order_diproses',
                    'order_id' => $this->data['order_id'],
                    'user_id' => $this->data['user_id'],
                    'product_name' => $this->data['product_name'],
                    'status_payment' => $this->data['status_payment'],
                    'status' => $this->data['status'],
                    'customer_name' => $this->data['customer_name'],
                    'payment_type' => $this->data['payment_type'],
                    'total_harga' => $this->data['total_harga'],
                    'profile_image' => $this->data['profile_image'],
                    'created_at' => now(),
                ];
            } elseif ($this->data['status'] == 'dikirim') {
                return [
                    'message' => "Pesanan #" . Str::limit($this->data['order_id'], 5, '...') . " telah dikirim",
                    'type_notification' => 'status_order_dikirim',
                    'order_id' => $this->data['order_id'],
                    'user_id' => $this->data['user_id'],
                    'product_name' => $this->data['product_name'],
                    'status_payment' => $this->data['status_payment'],
                    'status' => $this->data['status'],
                    'customer_name' => $this->data['customer_name'],
                    'payment_type' => $this->data['payment_type'],
                    'total_harga' => $this->data['total_harga'],
                    'profile_image' => $this->data['profile_image'],
                    'created_at' => now(),
                ];
            } elseif ($this->data['status'] == 'selesai') {
                return [
                    'message' => "Pesanan #" . Str::limit($this->data['order_id'], 5, '...') . " telah selesai",
                    'type_notification' => 'status_order_selesai',
                    'order_id' => $this->data['order_id'],
                    'user_id' => $this->data['user_id'],
                    'product_name' => $this->data['product_name'],
                    'status_payment' => $this->data['status_payment'],
                    'status' => $this->data['status'],
                    'customer_name' => $this->data['customer_name'],
                    'payment_type' => $this->data['payment_type'],
                    'total_harga' => $this->data['total_harga'],
                    'profile_image' => $this->data['profile_image'],
                    'created_at' => now(),
                ];
            }
        }

        // Default return untuk kasus yang tidak dikenali
        return [
            'message' => 'Notifikasi tidak dikenali.',
            'type_notification' => 'unknown',
        ];
    }
}
