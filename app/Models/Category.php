<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sea_price_start',
        'sea_price_end',
        'air_price_start',
        'air_price_end',
    ];

    protected function casts(): array
    {
        return [
            'sea_price_start' => 'decimal:2',
            'sea_price_end' => 'decimal:2',
            'air_price_start' => 'decimal:2',
            'air_price_end' => 'decimal:2',
        ];
    }
}
