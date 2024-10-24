<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionWelcome extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'question',
        'answer',
        'is_answer',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_answered' => 'boolean',
    ];
}
