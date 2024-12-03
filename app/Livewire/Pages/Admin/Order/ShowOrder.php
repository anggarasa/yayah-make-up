<?php

namespace App\Livewire\Pages\Admin\Order;

use App\Models\User;
use App\Models\Order;
use App\Notifications\OrderCreateNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-layout')]
class ShowOrder extends Component
{
    public Order $order;
    public $showFullDescription = false;
    public $descriptionLimit = 225; // Batasan karakter untuk tampilan awal

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function toggleDescription()
    {
        $this->showFullDescription = !$this->showFullDescription;
    }

    // Ubah status order
    public function updateStatus($status)
    {
        $this->order->update(['status' => $status]);

        $dataStatusNotif = [
            'order_id' => $this->order->id,
            'user_id' => $this->order->user_id,
            'status' => $status,
            'status_payment' => $this->order->status_payment,
            'payment_type' => $this->order->payment_type,
            'total_harga' => $this->order->total_harga,
            'customer_name' => $this->order->customer_name,
            'product_name' => $this->order->product->title,
            'profile_image' => $this->order->user->profile ?? null,
        ];

        $userNotif = User::find($this->order->user_id);
        Notification::send($userNotif, new OrderCreateNotification('update_status_order', $dataStatusNotif, 'user'));
    }
    
    public function render()
    {
        return view('livewire.pages.admin.order.show-order');
    }
}
