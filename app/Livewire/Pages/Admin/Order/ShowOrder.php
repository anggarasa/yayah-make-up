<?php

namespace App\Livewire\Pages\Admin\Order;

use App\Models\Order;
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
    
    public function render()
    {
        return view('livewire.pages.admin.order.show-order');
    }
}
