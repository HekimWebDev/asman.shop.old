<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = [
        'name',
        'slug',
        'owner',
        'address',
        'description'
    ];

    protected $fillable = [
        'service_category_id',
        'phone',
        'email',
        'image',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class)->withDefault();
    }
}
