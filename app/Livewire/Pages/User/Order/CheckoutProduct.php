<?php

namespace App\Livewire\Pages\User\Order;

use App\Models\BajuPernikahan;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Midtrans\Snap;

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

    public $akadDressId;
    
    public $resepsiDressIds = [];

    public $snapToken;

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
    }
    
    public function processCheckout()
    {
        try {
            $this->validate();
            
            $orderData = [
                'user_id' => auth()->id(),
                'product_id' => $this->product->id,
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

            // Hapus session
            session()->forget(['selected_akad_dress', 'selected_reception_dresses']);

            return redirect()->route('detail-pesanan', $order);

        } catch (\Exception $e) {
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
            'paymentType',
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
