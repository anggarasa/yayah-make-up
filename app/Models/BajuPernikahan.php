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
}
