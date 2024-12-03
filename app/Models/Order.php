<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'product_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'tanggal_pernikahan',
        'total_harga',
        'status',
        'status_payment',
        'payment_type',
        'akad_dress_id',
    ];

    // Belongs to Start
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public  function user()
    {
        return $this->belongsTo(User::class);
    }

    public function akadDress()
    {
        return $this->belongsTo(BajuPernikahan::class);
    }
    // Belongs to end

    // Has many Start
    // Has many End


    // Many to many Start
    public function resepsiDresses()
    {
        return $this->belongsToMany(BajuPernikahan::class, 'order_baju_pernikahan');
    }
    // Many to many End
}
