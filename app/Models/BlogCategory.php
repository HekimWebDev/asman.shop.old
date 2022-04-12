<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['slug', 'name', 'description'];

    protected $fillable = [
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function posts()
    {
        return $this->hasMany(BlogPost::class);
    }
}
