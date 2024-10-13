<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaProduct extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'product_id',
        'file_path',
        'media_type'
    ];

    // Belongs to Start
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // Belongs to End
}
