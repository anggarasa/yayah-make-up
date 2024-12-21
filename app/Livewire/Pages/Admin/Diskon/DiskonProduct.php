<?php

namespace App\Livewire\Pages\Admin\Diskon;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use App\Models\DiskonProduct as ModelsDiskonProduct;
use App\Livewire\Layout\Admin\Modals\Diskon\ModalDiskonProduct;

#[Layout('layouts.admin-layout')]
#[On('create-diskon-produk')]
class DiskonProduct extends Component
{

    public function editDiskonProduct($id)
    {
        $this->dispatch('editDiskonProduct', $id)->to(ModalDiskonProduct::class);
    }

    public function hapusDiskonProduct($id)
    {
        $this->dispatch('hapusDiskonProduct', $id)->to(ModalDiskonProduct::class);
    }

    // Ubah active diskon product
    public function updateStatusDiskonProduct($id, $status)
    {
        try {
            $diskonProduct = ModelsDiskonProduct::find($id);

            if (!$diskonProduct) {
                throw new \Exception('Diskon Product Tidak Ditemukan');
            }

            // Update status diskon
            $diskonProduct->update(['is_active' => $status]);

            // Ambil produk yang terkait dengan diskon
            $produkTerkait = $diskonProduct->products;

            if ($status === false) {
                // Jika status diubah menjadi false, set harga_diskon menjadi null
                Product::whereIn('id', $produkTerkait->pluck('id'))->update(['harga_diskon' => null]);
            } else {
                // Jika status diubah menjadi true, hitung ulang harga diskon
                foreach ($produkTerkait as $produk) {
                    // Hitung diskon produk
                    if ($diskonProduct->type == 'percentage') {
                        $harga_diskon = $produk->harga - ($produk->harga * ($diskonProduct->jumlah_diskon / 100));
                    } elseif ($diskonProduct->type == 'fixed') {
                        $harga_diskon = $produk->harga - $diskonProduct->jumlah_diskon;
                    }

                    // Pastikan harga tidak negatif
                    $harga_diskon = max(0, $harga_diskon);

                    // Ubah produk
                    $produk->update([
                        'harga_diskon' => $harga_diskon,
                    ]);
                }
            }

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Berhasil mengubah status diskon product.',
                'title' => 'Sukses'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Error'
            ]);
        }
    }
    
    public function render()
    {
        return view('livewire.pages.admin.diskon.diskon-product', [
            'diskons' => ModelsDiskonProduct::latest()->get(),
        ]);
    }
}
