<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = [
        'name',
        'slug'
    ];

    protected $fillable = [
        'order',
        'image',
        'icon',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function scopeHasActiveServices($query)
    {
        return $query->whereHas(
            'services',
            fn ($service) => $service->active()
        );
    }
}
