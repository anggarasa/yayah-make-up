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

    public $hasDresses = false;
    public $selectedAkadDress = null;
    public $selectedReceptionDresses = [];

    public $showFullDescription = false;
    public $descriptionLimit = 500; // Batasan karakter untuk tampilan awal

    public function mount($id)
    {
        $this->product = Product::with(['mediaProducts', 'dresses'])->findOrFail($id);
        
        // Memisahkan video dan gambar
        $videos = $this->product->mediaProducts->where('media_type', 'Video');
        $images = $this->product->mediaProducts->where('media_type', 'Image');
        
        // Menggabungkan video dan gambar, dengan video di awal
        $this->mediaProducts = $videos->concat($images)->values();

        $this->hasDresses = $this->product->dresses()
        ->whereIn('dress_type', ['Akad', 'Resepsi'])
        ->exists();
    }

    public function next()
    {
        $this->currentIndex = ($this->currentIndex + 1) % count($this->mediaProducts);
    }

    public function prev()
    {
        $this->currentIndex = ($this->currentIndex - 1 + count($this->mediaProducts)) % count($this->mediaProducts);
    }

    public function selectAkadDress($dressId)
    {
        $this->selectedAkadDress = $dressId;
    }

    public function toggleReceptionDress($dressId)
    {
        if (in_array($dressId, $this->selectedReceptionDresses)) {
            $this->selectedReceptionDresses = array_diff($this->selectedReceptionDresses, [$dressId]);
        } elseif (count($this->selectedReceptionDresses) < 2) {
            $this->selectedReceptionDresses[] = $dressId;
        }
    }

    public function toggleDescription()
    {
        $this->showFullDescription = !$this->showFullDescription;
    }
    
    public function render()
    {
        return view('livewire.pages.admin.product.paket.show-product');
    }
}
