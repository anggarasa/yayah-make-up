<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAdmin extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'type',
        'data',
        'read',
    ];

    public function admin()
    {
        return $this->belongsTo(AdminUser::class);
    }
}
