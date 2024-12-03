<?php

namespace App\Livewire\Pages\Admin\User;

use App\Models\Product;
use Livewire\Component;

class DetailProductUser extends Component
{

    public $product;
    public $mediaProducts = [];
    public $currentIndex = 0;

    public $selectedAkadDress = null;
    public $selectedReceptionDresses = [];
    public $hasDresses = false;

    public $message, $judul;

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

    public function checkout()
    {
        // Jika produk memiliki fitur pemilihan baju
        if ($this->hasDresses) {
            if (is_null($this->selectedAkadDress) && empty($this->selectedReceptionDresses)) {
                $this->judul = 'Error!';
                $this->message = 'Pilih minimal satu baju akad atau dua baju resepsi';
                $this->dispatch('checkout-error');
                return;
            }
            
            if (!empty($this->selectedReceptionDresses) && count($this->selectedReceptionDresses) !== 2) {
                $this->judul = 'Error!';
                $this->message = 'Pilih tepat 2 baju resepsi';
                $this->dispatch('checkout-error');
                return;
            }

            session([
                'selected_akad_dress' => $this->selectedAkadDress,
                'selected_reception_dresses' => $this->selectedReceptionDresses
            ]);
        }
        
        return redirect()->route('checkout', $this->product->id);
    }
    
    public function render()
    {
        return view('livewire.pages.admin.user.detail-product-user');
    }
}
