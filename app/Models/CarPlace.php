<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class CarPlace extends Model implements TranslatableContract
{
    use HasFactory, Translatable, NodeTrait;

    public $translatedAttributes = ['name'];

    protected $fillable = [
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }
}