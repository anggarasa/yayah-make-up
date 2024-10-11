<?php

namespace App\Livewire\Pages\Admin\Product\Paket;

use App\Models\BajuPernikahan;
use App\Models\CategoryProduct;
use App\Models\Product;
use Livewire\Component;
use App\Models\MediaProduct;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('layouts.admin-layout')]
class CreateProduct extends Component
{
    use WithFileUploads;

    #[Validate('required|string|max:255')]
    public $title;

    #[Validate('required|numeric|min:0')]
    public $harga;

    #[Validate('required')]
    public $description;

    #[Validate('required|image|mimes:png,jpg,jpeg|max:2000')]
    public $cover_image;

    #[Validate('required|exists:category_products,id')]
    public $category_product_id;

    #[Validate('nullable|array')]
    public $dress_akad = [];

    #[Validate('nullable|array')]
    public $dress_resepsi = [];

    #[Validate(['image_product.*' => 'required|image|mimes:png,jpg,jpeg|max:2000'])]
    public $image_product = [];

    #[Validate(['video_product.*' => 'nullable|file|mimes:mp4|max:200000'])]
    public $video_product = [];

    // modal notifikasi
    public $judul, $message;
    // modal notifikasi

    public function createProduct()
    {
        try {
            $this->validate();

            $coverImagePath = $this->cover_image->store('cover-image-product', 'public');
            
            $product = Product::create([
                'category_product_id' => $this->category_product_id,
                'title' => $this->title,
                'description' => $this->description,
                'harga' => $this->harga,
                'cover_image' => $coverImagePath,
            ]);

            // simpan baju akad
            foreach ($this->dress_akad as $akad) {
                $product->dresses()->attach($akad, ['type' => 'Akad']);
            }
            
            // simpan baju resepsi
            foreach ($this->dress_resepsi as $resepsi) {
                $product->dresses()->attach($resepsi, ['type' => 'Resepsi']);
            }

            foreach ($this->image_product as $image) {
                if ($image !== null) {
                    $imagePath = $image->store('file-product', 'public');

                    MediaProduct::create([
                        'product_id' => $product->id,
                        'file_path' => $imagePath,
                        'media_type' => 'Image',
                    ]);
                }
            }

            foreach ($this->video_product as $video) {
                if ($video !== null) {
                    $videoPath = $video->store('file-product', 'public');

                    MediaProduct::create([
                        'product_id' => $product->id,
                        'file_path' => $videoPath,
                        'media_type' => 'Video',
                    ]);
                }
            }

            $this->judul = 'Sukses!';
            $this->message = 'Berhasil menambahkan product baru!';
            $this->dispatch('product-success');
        } catch (\Exception $e) {
            $this->judul = 'Gagal!';
            $this->message = $e->getMessage();
            $this->dispatch('product-error');
        }
    }
    
    public function cencel()
    {
        $this->reset();
        $this->redirectIntended(route('list-product'), navigate: true);
    }

    protected $messages = [
        'title.required' => 'Judul wajib diisi',
        'title.max' => 'Judul maksimal 255 karakter',
        'harga.required' => 'Harga wajib diisi',
        'harga.numeric' => 'Harga harus berupa angka',
        'description.required' => 'Deskripsi wajib diisi',
        'cover_image.required' => 'Cover Image wajib diisi',
        'cover_image.image' => 'Cover Image harus berupa gambar',
        'cover_image.mimes' => 'Cover Image harus bertype PNG, JPG, dan JPEG',
        'cover_image.max' => 'Cover Image tidak boleh lebih dari 2MB',
        'category_product_id.required' => 'Kategori Product wajib dipilih',
        'image_product.*.required' => 'Gambar Product wajib dipilih',
        'image_product.*.image' => 'Gambar Product harus berupa gambar',
        'image_product.*.mimes' => 'Gambar Product harus bertype PNG, JPG, dan JPEG',
        'image_product.*.max' => 'Gambar Product tidak boleh lebih dari 2MB',
        'video_product.*.nullable' => 'Video Product bisa diletakkan',
        'video_product.*.mimes' => 'Video Product harus bertype MP4',
        'video_product.*.max' => 'Video Product tidak boleh lebih dari 200MB'
    ];
    
    public function render()
    {
        return view('livewire.pages.admin.product.paket.create-product', [
            'categoryProducts' => CategoryProduct::all(),
            'bajus' => BajuPernikahan::all()
        ]);
    }
}
