<?php

namespace App\Livewire\Pages\User\Order;

use App\Models\AdminUser;
use App\Models\BajuPernikahan;
use App\Models\Diskon;
use App\Models\Order;
use App\Models\Product;
use App\Notifications\OrderCreateNotification;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class CheckoutProduct extends Component
{
    public Product $product;

    #[Validate('required|string|max:255')]
    public $customer_name;

    #[Validate('required|email:rfc,dns,strict')]
    public $customer_email;
    
    #[Validate('required|min:10|max:13')]
    public $customer_phone;

    #[Validate('required')]
    public $customer_address;

    #[Validate('required')]
    public $tanggal_pernikahan;

    #[Validate('required')]
    public $totalHarga;

    #[Validate('nullable|string|max:255')]
    public $diskon_code;

    public $diskonId;

    public $originalHarga;

    public $akadDressId;
    
    public $resepsiDressIds = [];

    public $judul, $message;
    
    public function mount(Product $product)
    {
        $this->product = $product;
        
        // Cek apakah produk memiliki fitur baju
        if ($product->dresses()->exists()) {
            $akadDressId = session('selected_akad_dress');
            $receptionDressIds = session('selected_reception_dresses', []);
            
            $this->akadDressId = $akadDressId ? BajuPernikahan::find($akadDressId) : null;
            $this->resepsiDressIds = BajuPernikahan::whereIn('id', $receptionDressIds)->get();
        } else {
            // Jika produk tidak memiliki fitur baju, set nilai null/kosong
            $this->akadDressId = null;
            $this->resepsiDressIds = collect();
            
            // Hapus session baju
            session()->forget(['selected_akad_dress', 'selected_reception_dresses']);
        }
        
        $user = Auth::user();
        $this->customer_name = $user->name;
        $this->customer_email = $user->email;
        $this->customer_phone = $user->phone_number;
        $this->customer_address = $user->alamat;
        $this->totalHarga = $product->harga;
        $this->originalHarga = $product->harga;
    }

    // Check Kode diskon
    public function checkKodeDiskon()
    {
        // Kembalikan harga ke harga asli sebelum menerapkan diskon baru
        $this->totalHarga = $this->originalHarga;

        $diskon = null;
        if ($this->diskon_code) {
            $diskon = Diskon::where('code', $this->diskon_code)
                        ->where('is_active', true)
                        ->where('start_date', '<=', now())
                        ->where('end_date', '>=', now())
                        ->first();
        }

        if ($diskon) {
            if ($diskon->type == 'percentage') {
                $this->totalHarga -= $this->totalHarga * ($diskon->harga_diskon / 100);
            } elseif ($diskon->type == 'fixed') {
                $this->totalHarga -= $diskon->harga_diskon;
            }

            // Pastikan harga tidak negatif
            $this->totalHarga = max(1, $this->totalHarga);
            $this->diskonId = $diskon->id;

            // Bisa tambahkan flash message untuk konfirmasi diskon berhasil
            session()->flash('diskon_success', 'Kode diskon berhasil diterapkan!');
        } else {
            // Jika kode diskon tidak valid
            session()->flash('diskon_error', 'Kode diskon tidak valid.');
            
            // Kembalikan ke harga asli
            $this->totalHarga = $this->originalHarga;
        }
    }
    
    public function processCheckout()
    {
        $order = null; // Inisialisasi variabel order
        
        try {
            $this->validate();

            // cek jika totalHarga 0
            if ($this->totalHarga == 0) {
                $this->totalHarga = 1;
            }
            
            $orderData = [
                'user_id' => auth()->id(),
                'product_id' => $this->product->id,
                 'diskon_id' => $this->diskonId,
                'customer_name' => $this->customer_name,
                'customer_phone' => $this->customer_phone,
                'customer_email' => $this->customer_email,
                'customer_address' => $this->customer_address,
                'tanggal_pernikahan' => $this->tanggal_pernikahan,
                'total_harga' => $this->totalHarga,
                'status' => 'pembayaran',
            ];

            // Tambahkan akad_dress_id hanya jika produk memiliki fitur baju
            if ($this->product->dresses()->exists() && $this->akadDressId) {
                $orderData['akad_dress_id'] = $this->akadDressId->id;
            }

            $order = Order::create($orderData);

            // Tambahkan resepsi dresses hanya jika produk memiliki fitur baju
            if ($this->product->dresses()->exists() && !empty($this->resepsiDressIds)) {
                foreach ($this->resepsiDressIds as $resepsi) {
                    $order->resepsiDresses()->attach($resepsi);
                }
            }

            $dataOrder = [
                'order_id' => $order->id,
                'product_name' => $this->product->title,
                'customer_name' => $this->customer_name,
                'total_harga' => $this->totalHarga,
                'profile_image' => auth()->user()->profile ?? null,
            ];

            $adminUser = AdminUser::where('role', 'admin')->get();
            Notification::send($adminUser, new OrderCreateNotification('order_created', $dataOrder, 'admin'));

            // Hapus session
            session()->forget(['selected_akad_dress', 'selected_reception_dresses']);

            return redirect()->route('detail-pesanan', $order);

        } catch (\Exception $e) {

            // Jika order berhasil dibuat, hapus order tersebut
            if ($order) {
                $order->delete(); // Menghapus order yang berhasil dibuat
            }
            
            $this->judul = 'Error!';
            $this->message = $e->getMessage();
            $this->dispatch('checkout-error');
        }
    }

    public function cencelCheckout()
    {
        
        $this->reset([
            'customer_name',
            'customer_email',
            'customer_phone',
            'customer_address',
            'tanggal_pernikahan',
            'akadDressId',
            'resepsiDressIds',
            'totalHarga',
        ]);
        $this->redirect(route('detail-product-user', $this->product->id), navigate: true);
    }
    
    public function render()
    {
        return view('livewire.pages.user.order.checkout-product');
    }

    protected $messages = [
        'customer_name.required' => 'Isi nama lengkap anda',
        'customer_email.required' => 'Isi alamat email anda',
        'customer_email.email' => 'Alamat Email anda tidak valid',
        'customer_phone.required' => 'Isi No . Telepon anda',
        'customer_phone.numeric' => 'No . Telepon harus berupa angka',
        'customer_phone.max' => 'No . Telepon maksimal 13 angka',
        'customer_phone.max' => 'No . Telepon minimal 10 - 12 angka',
        'customer_address.required' => 'Isi alamat tempat pernikahan anda',
        'tanggal_pernikahan.required' => 'Isi tanggal pernikahan anda',
        'tanggal_pernikahan.required' => 'Isi tanggal pernikahan anda',
        'paymentType.required' => 'Pilih tipe pembayaran',
    ];

}
