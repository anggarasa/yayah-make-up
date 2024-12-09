<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'category_product_id',
        'title',
        'cover_image',
        'harga',
        'harga_diskon',
        'description'
    ];

    // Hash many Start
    public function mediaProducts()
    {
        return $this->hasMany(MediaProduct::class);
    }
    // Hash many End

    // Belongs to Start
    public function categoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class);
    }
    // Belongs to End

    // Many to many Start
    public function dresses()
    {
        return $this->belongsToMany(BajuPernikahan::class, 'product_baju')->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')->withTimestamps();
    }

    public function diskonProducts()
    {
        return $this->belongsToMany(DiskonProduct::class, 'diskons_products')->withTimestamps();
    }
    // Many to many End

    // Format Product Start
    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->attributes['harga'], 0, ',', '.');
    }
    // Format Product End

    // Cover image product Start
    public function getCoverImage()
    {
        // Pilih gambar pertama yang berjenis 'image'
        return $this->mediaProducts->where('media_type', 'Image')->first();
    }
    // Cover image product End
}
