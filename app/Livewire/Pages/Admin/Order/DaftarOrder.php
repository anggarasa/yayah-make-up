<?php

namespace App\Livewire\Pages\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-layout')]
class DaftarOrder extends Component
{
    public $selectedStatus = 'all'; // Status yang dipilih
    public $orders; // Menyimpan data pesanan

    public $filters = [
        'pembayaran' => 'Pembayaran',
        'diproses' => 'Di Proses',
        'dikirim' => 'Di Kirim',
        'dibatalkan' => 'Di Batalkan',
        'selesai' => 'Selesai'
    ];
    
    public function mount()
    {
        $this->orders = Order::latest()->get(); // Mengambil semua data pesanan dari database
    }

    public function render()
    {
        return view('livewire.pages.admin.order.daftar-order', [
            'filteredOrders' => $this->getFilteredOrders(), // Mengambil pesanan yang difilter
        ]);
    }

    public function getFilteredOrders()
    {
        if ($this->selectedStatus === 'all') {
            return $this->orders;
        }

        return $this->orders->where('status', $this->selectedStatus);
    }
}
