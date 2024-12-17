<?php

namespace App\Livewire\Layout\Admin\Modals\Diskon;

use App\Livewire\Pages\Admin\Diskon\DiskonProduct as DiskonDiskonProduct;
use App\Models\DiskonProduct;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.admin-layout')]
class ModalDiskonProduct extends Component
{
    public $name, $jumlah_diskon, $type, $start_date, $end_date;

    public $produks = [];

    public $is_edit = false;
    public $diskonProductId;

    public $judul, $message;

    #[On('editDiskonProduct')]
    public function editDiskonProduct($id)
    {
        $diskonProduct = DiskonProduct::find($id);
        $this->is_edit = true;
        $this->diskonProductId = $id;
        $this->name = $diskonProduct->name;
        $this->jumlah_diskon = $diskonProduct->jumlah_diskon;
        $this->type = $diskonProduct->type;
        $this->start_date = $diskonProduct->start_date;
        $this->end_date = $diskonProduct->end_date;

        $this->produks = $diskonProduct->products()->pluck('products.id')->toArray();
        $this->dispatch('modal-diskon-product');
    }

    #[On('hapusDiskonProduct')]
    public function hapusDiskonProduct($id)
    {
        $this->resetInput();
        $diskonProduct = DiskonProduct::find($id);
        $this->diskonProductId = $id;
        $this->name = $diskonProduct->name;

        $this->dispatch('modal-confirmasi-diskon-prouduct');
    }

    public function createDiskonProduct()
    {
        
        try {
            $this->validate([
                'name' => 'required|string|max:255',
                'jumlah_diskon' => 'required|numeric',
                'type' => 'required',
                'produks' => 'required|array',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $diskonProduk = DiskonProduct::create([
                'name' => $this->name,
                'jumlah_diskon' => $this->jumlah_diskon,
                'type' => $this->type,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            foreach ($this->produks as $produkId) {
                $produk = Product::find($produkId); // Ambil objek produk
            
                if (!$produk) {
                    continue; // Lewati jika produk tidak ditemukan
                }
            
                $diskonProduk->products()->attach($produkId);
            
                // Hitung diskon produk
                if ($diskonProduk->type == 'percentage') {
                    $harga_diskon = $produk->harga - ($produk->harga * ($diskonProduk->jumlah_diskon / 100));
                } elseif ($diskonProduk->type == 'fixed') {
                    $harga_diskon = $produk->harga - $diskonProduk->jumlah_diskon;
                }
            
                // Pastikan harga tidak negatif
                $harga_diskon = max(0, $harga_diskon);
            
                // Ubah produk
                $produk->update([
                    'harga_diskon' => $harga_diskon,
                ]);
            }

            $this->dispatch('create-diskon-produk')->to(DiskonDiskonProduct::class);
            $this->dispatch('close-modal-diskon-product');
            $this->reset(['produks', 'name', 'jumlah_diskon', 'type','start_date', 'end_date']);

            $this->judul = 'Suceess';
            $this->message = 'Diskon Product Berhasil Dibuat';
            $this->dispatch('diskon-product-success');
        } catch (\Exception $e) {
            $this->judul = 'Error';
            $this->message = $e->getMessage();
            $this->dispatch('diskon-product-error');
        }
    }

    // Update diskon-product
    public function updateDiskonProduct()
    {
        try {
            $diskonProduk = DiskonProduct::find($this->diskonProductId);
            if (!$diskonProduk) {
                throw new \Exception('Diskon Product Tidak Ditemukan');
            }

            $this->validate([
                'name' => 'required|string|max:255',
                'jumlah_diskon' => 'required|numeric',
                'type' => 'required',
                'produks' => 'required|array',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $diskonProduk->update([
                'name' => $this->name,
                'jumlah_diskon' => $this->jumlah_diskon,
                'type' => $this->type,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
            ]);

            // Ambil ID produk sebelumnya
            $produkSebelumnya = $diskonProduk->products()->pluck('products.id')->toArray();

            // Sinkronisasi produk dengan diskon
            $diskonProduk->products()->sync($this->produks);

            // Atur harga_diskon menjadi null untuk produk yang tidak lagi terhubung
            $produkTidakTerhubung = array_diff($produkSebelumnya, $this->produks);
            Product::whereIn('id', $produkTidakTerhubung)->update(['harga_diskon' => null]);

            // Hitung ulang harga diskon untuk produk yang terhubung
            foreach ($this->produks as $produkId) {
                $produk = Product::find($produkId); 

                if (!$produk) {
                    continue; 
                }

                // Hitung diskon produk
                if ($diskonProduk->type == 'percentage') {
                    $harga_diskon = $produk->harga - ($produk->harga * ($diskonProduk->jumlah_diskon / 100));
                } elseif ($diskonProduk->type == 'fixed') {
                    $harga_diskon = $produk->harga - $diskonProduk->jumlah_diskon;
                }

                // Pastikan harga tidak negatif
                $harga_diskon = max(0, $harga_diskon);

                // Ubah produk
                $produk->update([
                    'harga_diskon' => $harga_diskon,
                ]);
            }

            $this->dispatch('create-diskon-produk')->to(DiskonDiskonProduct::class);
            $this->dispatch('close-modal-diskon-product');
            $this->reset(['produks', 'name', 'jumlah_diskon', 'type', 'start_date', 'end_date']);
            $this->judul = 'Success';
            $this->message = 'Diskon Product Berhasil Diupdate';
            $this->dispatch('diskon-product-success');
        } catch (\Exception $e) {
            $this->judul = 'Error';
            $this->message = $e->getMessage();
            $this->dispatch('diskon-product-error');
        }
    }

    public function deleteDiskonProduct()
    {
        try {
            $diskonProduct = DiskonProduct::find($this->diskonProductId);

            $diskonProduct->delete();

            $this->dispatch('create-diskon-produk')->to(DiskonDiskonProduct::class);
            $this->resetInput();
            
            $this->judul = 'Success';
            $this->message = 'Diskon Product Berhasil Dihapus';
            $this->dispatch('diskon-product-success');
        } catch (\Exception $e) {
            $this->judul = 'Error';
            $this->message = $e->getMessage();
            $this->dispatch('diskon-product-error');
        }
    }
    
    public function render()
    {
        return view('livewire.layout.admin.modals.diskon.modal-diskon-product', [
            'products' => Product::all()
        ]);
    }

    protected $messages = [
        'name.required' => 'Nama diskon wajib diisi.',
        'name.max' => 'Maksimal nama diskon sebanyak 255 karakter.',
        'jumlah_diskon.required' => 'Jumlah diskon wajib diisi.',
        'jumlah_diskon.numeric' => 'Jumlah diskon harus berupa angka.',
        'type.required' => 'Pilih type diskon wajib diisi.',
        'produks.required' => 'Pilih produk yang akan diberi diskon.',
        'start_date.required' => 'Tanggal mulai diskon wajib diisi.',
        'start_date.date' => 'Tanggal mulai diskon harus berupa tanggal.',
        'end_date.required' => 'Tanggal akhir diskon wajib diisi.',
        'end_date.date' => 'Tanggal akhir diskon harus berupa tanggal.',
        'end_date.after_or_equal:start_date' => 'Tanggal akhir diskon harus setelah tanggal mulai.',
    ];

    public function resetInput()
    {
        $this->reset(['name', 'jumlah_diskon', 'type','start_date', 'end_date', 'diskonProductId']);
        $this->is_edit = false;
        $this->dispatch('close-modal-diskon-product');
        $this->dispatch('close-modal-confirmasi-diskon-prouduct');
    }
}
