<?php

namespace App\Livewire\Pages\User\Order;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.profile-user-layout')]
class MyOrder extends Component
{
    public $activeFilter = 'all';
    public $filters = [
        'pembayaran' => 'Pembayaran',
        'diproses' => 'Di Proses',
        'dikirim' => 'Di Kirim',
        'dibatalkan' => 'Di Batalkan',
        'selesai' => 'Selesai'
    ];

    public function changeFilter($filter)
    {
        $this->activeFilter = $filter;
    }

    public function render()
    {
        $orders = Order::when($this->activeFilter !== 'all', function ($query) {
            return $query->where('status', $this->activeFilter);
        })->latest()->get();
        return view('livewire.pages.user.order.my-order', [
            'orders' => $orders
        ]);
    }
}
