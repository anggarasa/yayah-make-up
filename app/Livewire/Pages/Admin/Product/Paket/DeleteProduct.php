<?php

namespace App\Livewire\Pages\Admin\Product\Paket;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin-layout')]
class DeleteProduct extends Component
{
    public $productId, $title, $cover_image, $harga;

    public $judul, $message;

    public function mount($id)
    {
        $product = Product::find($id);
        $this->productId = $product->id;
        $this->title = $product->title;
        $this->cover_image = $product->cover_image;
        $this->harga = $product->harga;
    }

    public function deleteProduct()
    {
        $product = Product::find($this->productId);

        if ($product) {
            // Hapus cover_image dari storage
            if (Storage::exists($product->cover_image)) {
                Storage::delete($product->cover_image);
            }

            // Hapus semua media_files dari storage
            foreach ($product->mediaProducts as $media) {
                if (Storage::exists($media->file_path)) {
                    Storage::delete($media->file_path);
                }
            }

            // Hapus produk dan media dari database
            $product->mediaProducts()->delete(); // Menghapus media terkait
            $product->delete(); // Menghapus produk

            // Kirim pesan sukses atau notifikasi
            $this->judul = 'Sukses!';
            $this->message = 'Berhasil menghapus produk "'. $this->title. '".';
            $this->dispatch('product-success');
        } else {
            $this->judul = 'Gagal!';
            $this->message = 'Gagal menghapus product';
            $this->dispatch('product-error');
        }
    }

    public function cencel()
    {
        $this->reset();
        $this->redirectIntended(route('list-product'), navigate: true);
    }
    
    public function render()
    {
        return view('livewire.pages.admin.product.paket.delete-product');
    }
}
