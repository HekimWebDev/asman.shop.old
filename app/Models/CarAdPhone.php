<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarAdPhone extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_ad_id',
        'phone'
    ];

    public function carAd()
    {
        return $this->belongsTo(CarAd::class);
    }

    public function getPhoneNumberAttribute()
    {
        return '+993 ' . $this->phone;
    }
}