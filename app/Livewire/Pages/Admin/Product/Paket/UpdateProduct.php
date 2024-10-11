<?php

namespace App\Livewire\Pages\Admin\Product\Paket;

use App\Models\BajuPernikahan;
use App\Models\CategoryProduct;
use App\Models\MediaProduct;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin-layout')]
class UpdateProduct extends Component
{
    use WithFileUploads;
    public $productId, $imageLama, $videoLama, $coverLama;
    
    #[Validate('required|string|max:255')]
    public $title;

    #[Validate('required|numeric|min:0')]
    public $harga;

    #[Validate('required')]
    public $description;

    #[Validate('nullable|image|mimes:png,jpg,jpeg|max:2000')]
    public $cover_image;

    #[Validate('required|exists:category_products,id')]
    public $category_product_id;

    #[Validate('nullable|array')]
    public $dress_akad = [];

    #[Validate('nullable|array')]
    public $dress_resepsi = [];

    #[Validate(['image_product.*' => 'nullable|image|mimes:png,jpg,jpeg|max:2000'])]
    public $image_product = [];

    #[Validate(['video_product.*' => 'nullable|file|mimes:mp4|max:200000'])]
    public $video_product = [];

    // modal notifikasi
    public $judul, $message;
    // modal notifikasi
    
    public function mount($id = null)
    {
        if($id) {
            $this->productId = $id;
            $product = Product::with(['mediaProducts'])->findOrFail($id);
            $this->title = $product->title;
            $this->harga = $product->harga;
            $this->description = $product->description;
            $this->coverLama = $product->cover_image;
            $this->category_product_id = $product->category_product_id;

            $this->dress_akad = $product->dresses()->wherePivot('type', 'Akad')->pluck('baju_pernikahan_id')->all();
            $this->dress_resepsi = $product->dresses()->wherePivot('type', 'Resepsi')->pluck('baju_pernikahan_id')->all();
            $this->imageLama = $product->mediaProducts;
            $this->videoLama = $product->mediaProducts;
        }
    }

    public function updateProduct()
    {
        try {
            $this->validate();

            $product = Product::findOrFail($this->productId);
            if ($this->cover_image) {
                // Hapus cover_image lama
                if (Storage::exists($product->cover_image)) {
                    Storage::delete($product->cover_image);
                }
                $coverImagePath = $this->cover_image->store('cover-image-product', 'public');
            }

            $product->update([
                'category_product_id' => $this->category_product_id,
                'title' => $this->title,
                'description' => $this->description,
                'harga' => $this->harga,
                'cover_image' => $coverImagePath?? $product->cover_image,
            ]);

            // Sync dresses for each type
            $syncData = [];
            foreach ($this->dress_akad as $akadId) {
                $syncData[$akadId] = ['type' => 'Akad'];
            }
            foreach ($this->dress_resepsi as $resepsiId) {
                $syncData[$resepsiId] = ['type' => 'Resepsi'];
            }
            $product->dresses()->sync($syncData);

            // Hapus imageproduct lama
            if ($this->image_product) {
                $imageProducts = $product->mediaProducts->where('media_type', 'Image');
                foreach ($imageProducts as $image) {
                    Storage::delete('public/' . $image->file_path);
                    $image->delete();
                }
            }

            // Simpan imageProducts baru
            if (!empty($this->image_product)) {
                foreach ($this->image_product as $image) {
                    $imagePath = $image->store('file-product', 'public');
                    MediaProduct::create([
                        'product_id' => $product->id,
                        'file_path' => $imagePath,
                        'media_type' => 'Image',
                    ]);
                }
            }

            // Hapus videoproduct lama
            if ($this->video_product) {
                $videoProducts = $product->mediaProducts->where('media_type', 'Video');
                foreach ($videoProducts as $video) {
                    Storage::delete('public/' . $video->file_path);
                    $video->delete();
                }
            }

            // Simpan videoProducts baru
            if (!empty($this->video_product)) {
                foreach ($this->video_product as $video) {
                    $videoPath = $video->store('file-product', 'public');
                    MediaProduct::create([
                        'product_id' => $product->id,
                        'file_path' => $videoPath,
                        'media_type' => 'Video',
                    ]);
                }
            }

            $this->judul = 'Sukses!';
            $this->message = 'Produk berhasil diperbarui.';
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
        'cover_image.nullable' => 'Cover Image bisa diletakkan',
        'cover_image.image' => 'Cover Image harus berupa gambar',
        'cover_image.mimes' => 'Cover Image harus bertype PNG, JPG, dan JPEG',
        'cover_image.max' => 'Cover Image tidak boleh lebih dari 2MB',
        'category_product_id.required' => 'Kategori Product wajib dipilih',
        'image_product.*.nullable' => 'Gambar Product bisa diletakkan',
        'image_product.*.image' => 'Gambar Product harus berupa gambar',
        'image_product.*.mimes' => 'Gambar Product harus bertype PNG, JPG, dan JPEG',
        'image_product.*.max' => 'Gambar Product tidak boleh lebih dari 2MB',
        'video_product.*.nullable' => 'Video Product bisa diletakkan',
        'video_product.*.mimes' => 'Video Product harus bertype MP4',
        'video_product.*.max' => 'Video Product tidak boleh lebih dari 200MB'
    ];
    
    public function render()
    {
        return view('livewire.pages.admin.product.paket.update-product', [
            'bajus' => BajuPernikahan::all(),
            'categoryProducts' => CategoryProduct::all()
        ]);
    }
}
