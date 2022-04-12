<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_brand_id',
        'name',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    public function carBrand()
    {
        return $this->belongsTo(CarBrand::class)->withDefault('null');
    }
}
