<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Log;

class PaymentNotification extends Controller
{
    public function index()
    {
        return view('user/notification/payment-notification');
    }
    
    public function handleWebhook(Request $request)
    {
        // Ambil data dari webhook
        $data = $request->all();

        $order = Order::findOrFail($data['order_id']);

        // Log data untuk debugging
        Log::info('Webhook received: ', $data);

        // Cek status pembayaran
        if ($data['transaction_status'] == 'settlement') {
            // Status pembayaran berhasil
            $order->update([
                'status' => 'diproses',
                'status_payment' => $data['transaction_status'],
                'payment_type' => $data['payment_type'],
            ]);
        } elseif ($data['transaction_status'] == 'pending') {
            // Pembayaran masih pending
            $order->update([
                'status_payment' => $data['transaction_status'],
            ]);
        } elseif ($data['transaction_status'] == 'cancel' || $data['transaction_status'] == 'expire') {
            // Pembayaran gagal
            $order->update([
                'status_payment' => $data['transaction_status'],
            ]);
        }

        return redirect()->route('payment.index');
    }
}
