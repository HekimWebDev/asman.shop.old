<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'advertisement_product_id',
        'image',
    ];
}
