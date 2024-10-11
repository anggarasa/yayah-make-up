<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BajuPernikahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image_dress',
        'dress_type'
    ];

    // Many to many Start
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_baju')->withTimestamps();
    }
    // Many to many End
}
