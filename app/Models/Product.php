<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['slug', 'name', 'description'];
    protected $fillable = [
        'category_id',
        'price',
        'status',
        'hit',
        'brand_id',
        'image',
        'discount_price',
        'vendor_code',
        'quantity',
        'one_c_id',
        'one_c_category_id',
    ];
    protected $appends = ['is_compared'];
    protected $casts = [
        'is_compared' => 'boolean',
        'hit' => 'boolean',
    ];

    // protected $with = [
    //     'translation'
    // ];

    public function getIsComparedAttribute()
    {
        $products = session('compare.products') ?? collect();
        return $products->contains($this->id);
    }

    public function scopeWhereSlug($query, $slug)
    {
        return $query->whereTranslation('slug', $slug);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInStock($query)
    {
        return $query->active()->where('quantity', '>', 0)->where('price', '>', 0);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'one_c_category_id', 'one_c_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function image()
    {
        return $this->hasMany(ProductImage::class)->first()->image ?? '';
    }

    public function attributeValues()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_value');
    }

    public function scopeNew($query)
    {
        return $query->inStock()->latest();
    }

    public function scopeHit($query)
    {
        return $query->inStock()->whereHit(1)->latest();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function blocks()
    {
        return $this->belongsToMany(Block::class);
    }
}
