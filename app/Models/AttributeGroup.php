<?php

namespace App\Models;

use App\Base\Traits\HasTranslations;
use App\Models\AttributeGroupFactory;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MigrationsGenerator\Models\Model;

class AttributeGroup extends Model
{
    use HasFactory;
    use HasTranslations;

    /**
     * Return a new factory instance for the model.
     *
     * @return AttributeGroupFactory
     */
    protected static function newFactory(): AttributeGroupFactory
    {
        return AttributeGroupFactory::new();
    }

    /**
     * Define which attributes should be
     * protected from mass assignment.
     *
     * @var array
     */
    protected array $guarded = [];

    /**
     * Define which attributes should be cast.
     *
     * @var array
     */
    protected array $casts = [
        'name' => AsCollection::class,
    ];

    /**
     * Return the attributes relationship.
     *
     * @return HasMany
     */
    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class)->orderBy('position');
    }
}
