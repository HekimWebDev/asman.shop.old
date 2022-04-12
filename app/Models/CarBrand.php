<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarBrand extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public function carModels()
    {
        return $this->hasMany(CarModel::class);
    }
}