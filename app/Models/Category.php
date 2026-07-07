<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price_start',
        'price_end',
    ];

    protected function casts(): array
    {
        return [
            'price_start' => 'decimal:2',
            'price_end' => 'decimal:2',
        ];
    }
}
