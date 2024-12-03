<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'code',
        'harga_diskon',
        'type',
        'start_date',
        'end_date',
        'is_active',
    ];

    // Has many start
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    // Has many end
}
