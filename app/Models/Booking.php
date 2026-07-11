<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'item_name',
        'category_id',
        'method',
        'tracking',
        'total_carton',
        'total_quantity',
        'total_weight',
        'sensitive_goods',
        'delivery_method',
        'district_id',
        'address',
        'note',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tracking' => 'array',
            'total_weight' => 'decimal:2',
            'sensitive_goods' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function histories()
    {
        return $this->hasMany(BookingHistory::class);
    }
}
