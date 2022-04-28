<?php

namespace App\Models;

use App\Base\Traits\HasAttributes;
use Database\Factories\ProductTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class ProductType extends Model
{
    use HasAttributes;
    use HasFactory;

    /**
     * Return a new factory instance for the model.
     *
     * @return ProductTypeFactory
     */
    protected static function newFactory(): ProductTypeFactory
    {
        return ProductTypeFactory::new();
    }

    /**
     * Define which attributes should be
     * protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the mapped attributes relation.
     *
     * @return MorphToMany
     */
    public function mappedAttributes(): MorphToMany
    {
//        $prefix = config('getcandy.database.table_prefix');

        return $this->morphToMany(
            Attribute::class,
            'attributable',
            "attributables"
        )->withTimestamps();
    }

    /**
     * Return the product attributes relationship.
     *
     * @return MorphToMany
     */
    public function productAttributes(): MorphToMany
    {
        return $this->mappedAttributes()->whereAttributeType(Product::class);
    }

    /**
     * Return the variant attributes relationship.
     *
     * @return MorphToMany
     */
    public function variantAttributes()
    {
        return $this->mappedAttributes()->whereAttributeType(ProductVariant::class);
    }

    /**
     * Get the products relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
