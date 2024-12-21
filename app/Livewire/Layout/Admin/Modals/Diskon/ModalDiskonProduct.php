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

            // Cek apakah start_date sama dengan hari ini
            $today = now()->format('Y-m-d'); // Mengambil tanggal hari ini
            $isToday = $this->start_date === $today;

            // Tentukan is_active berdasarkan start_date
            $is_active = $isToday ? true : false;

            // Buat diskon produk
            $diskonProduk = DiskonProduct::create([
                'name' => $this->name,
                'jumlah_diskon' => $this->jumlah_diskon,
                'type' => $this->type,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'is_active' => $is_active, // Tambahkan is_active
            ]);

            // Jika start_date adalah hari ini, update harga_diskon produk
            if ($isToday) {
                foreach ($this->produks as $produkId) {
                    $product = Product::find($produkId);
                    if ($product) {
                        // Hitung harga setelah diskon berdasarkan tipe diskon
                        if ($this->type == 'percentage') {
                            // Diskon dalam persentase
                            $diskonNominal = $product->harga * ($this->jumlah_diskon / 100);
                            $hargaSetelahDiskon = $product->harga - $diskonNominal;
                        } elseif ($diskonProduk->type == 'fixed') {
                            $hargaSetelahDiskon = $product->harga - $diskonProduk->jumlah_diskon;
                        }

                        // Pastikan harga setelah diskon tidak negatif
                        $hargaSetelahDiskon = max(0, $hargaSetelahDiskon);

                        $product->harga_diskon = $hargaSetelahDiskon;
                        $product->save(); // Simpan perubahan
                    }
                }
            }

            // Lampirkan produk ke diskon produk
            foreach ($this->produks as $produkId) {
                $diskonProduk->products()->attach($produkId);
            }

            $this->dispatch('create-diskon-produk')->to(DiskonDiskonProduct::class);
            $this->resetInput();

            $this->dispatch('notificationAdmin', [
                'type' => 'success',
                'message' => 'Diskon Product Berhasil Dibuat',
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

            // Cek apakah start_date sama dengan hari ini
            $today = now()->format('Y-m-d');
            $isToday = $this->start_date === $today;

            // Tentukan is_active berdasarkan start_date
            $is_active = $isToday ? true : false;

            $diskonProduk->update([
                'name' => $this->name,
                'jumlah_diskon' => $this->jumlah_diskon,
                'type' => $this->type,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'is_active' => $is_active,
            ]);

            // Ambil ID produk sebelumnya
            $produkSebelumnya = $diskonProduk->products()->pluck('products.id')->toArray();

            // Sinkronisasi produk dengan diskon
            $diskonProduk->products()->sync($this->produks);

            // Atur harga_diskon menjadi null untuk produk yang tidak lagi terhubung
            $produkTidakTerhubung = array_diff($produkSebelumnya, $this->produks);
            Product::whereIn('id', $produkTidakTerhubung)->update(['harga_diskon' => null]);

            // Hitung ulang harga diskon untuk produk yang terhubung, hanya jika start_date adalah hari ini
            if ($isToday) {
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
            } else {
                // Jika start_date tidak sama dengan hari ini, set harga_diskon menjadi null untuk semua produk terkait
                Product::whereIn('id', $this->produks)->update(['harga_diskon' => null]);
            }

            $this->dispatch('create-diskon-produk')->to(DiskonDiskonProduct::class);
            $this->resetInput();

            $this->dispatch('notificationAdmin', [
                'type' =>'success',
                'message' => 'Diskon Product Berhasil Diubah',
                'title' => 'Sukses'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notificationAdmin', [
                'type' =>'error',
                'message' => $e->getMessage(),
                'title' => 'Error'
            ]);
        }
    }

    public function deleteDiskonProduct()
    {
        try {
            $diskonProduct = DiskonProduct::find($this->diskonProductId);

            if (!$diskonProduct) {
                throw new \Exception('Diskon Product Tidak Ditemukan');
            }

            // Ambil ID produk yang terkait dengan diskon
            $produkTerkait = $diskonProduct->products()->pluck('products.id')->toArray();

            // Set harga_diskon menjadi null untuk semua produk yang terkait dengan diskon
            Product::whereIn('id', $produkTerkait)->update(['harga_diskon' => null]);

            // Hapus diskon
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
