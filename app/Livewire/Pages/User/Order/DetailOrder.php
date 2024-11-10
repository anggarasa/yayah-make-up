<?php

namespace App\Livewire\Pages\User\Order;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Payment;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;

class DetailOrder extends Component
{
    public Order $order;

    public $judul, $message;

    public function mount(Order $order)
    {
        $this->order = $order;
    }

    public function payment()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $this->order->id . '-' . time(),
                'gross_amount' => $this->order->total_harga,
            ],
            'customer_details' => [
                'first_name' => $this->order->customer_name,
                'email' => $this->order->customer_email,
                'phone' => $this->order->customer_phone,
                'shipping_address' => [
                    'first_name' => $this->order->customer_name,
                    'address' => $this->order->customer_address,
                    'phone' => $this->order->customer_phone,
                    'email' => $this->order->customer_email,
                ],
            ],
            'item_details' => [
                [
                    'id' => $this->order->product->id,
                    'price' => $this->order->product->harga,
                    'quantity' => 1,
                    'name' => $this->order->product->title,
                    'category' => $this->order->product->categoryProduct->name
                ],
            ]
        ];

        $snapToken = Snap::getSnapToken($params);

        $this->dispatch('payment-order', ['snapToken' => $snapToken]);
        
    }

    public function handlePaymentSuccess($result)
    {
        $this->order->update([
            'status' => 'diproses',
            'status_payment' => $result['transaction_status'],
            'payment_type' => $result['payment_type'],
        ]);

        $this->judul = 'Success';
        $this->message = 'Pembayaran berhasil. Order anda akan segera diproses.';
        $this->dispatch('checkout-success');
    }

    public function handlePaymentError($result)
    {
        $this->order->update([
            'status_payment' => $result['transaction_status'],
            'payment_type' => $result['payment_type'],
        ]);
        
        $this->judul = 'Error';
        $this->message = 'Pembayaran gagal. Silahkan coba lagi.';
        $this->dispatch('checkout-error');
    }

    public function render()
    {
        return view('livewire.pages.user.order.detail-order');
    }
}