<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['slug', 'name'];

    protected $fillable = [
        'status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
