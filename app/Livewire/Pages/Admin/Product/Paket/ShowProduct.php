<?php

namespace App\Livewire\Pages\Admin\Product\Paket;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin-layout')]
class ShowProduct extends Component
{
    public $product;
    public $mediaProducts = [];
    public $currentIndex = 0;

    public function mount($id)
    {
        $this->product = Product::with(['mediaProducts', 'dresses'])->findOrFail($id);
        
        // Memisahkan video dan gambar
        $videos = $this->product->mediaProducts->where('media_type', 'Video');
        $images = $this->product->mediaProducts->where('media_type', 'Image');
        
        // Menggabungkan video dan gambar, dengan video di awal
        $this->mediaProducts = $videos->concat($images)->values();
    }

    public function next()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->mediaProducts);
    }

    public function prev()
    {
        $this->currentIndex = ($this->currentIndex - 1 + count($this->mediaProducts)) % count($this->mediaProducts);
    }
    
    public function render()
    {
        return view('livewire.pages.admin.product.paket.show-product');
    }
}
