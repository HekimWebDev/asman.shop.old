<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarAdType extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_ad_id',
        'type',
        'expire_date',
        'is_active'
    ];

    protected $casts = [
        'type' => 'string',
        'expire_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function scopeIsActive()
    {
        return $this->where('is_active', true);
    }

    public function carAd(): BelongsTo
    {
        return $this->belongsTo(CarAd::class);
    }
}
