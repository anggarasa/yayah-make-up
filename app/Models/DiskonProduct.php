<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiskonProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'jumlah_diskon',
        'type',
        'start_date',
        'end_date',
        'is_active',
    ];

    // Many to many Start
    public function products()
    {
        return $this->belongsToMany(Product::class, 'diskons_products')->withTimestamps();
    }
    // Many to many End
}
