<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Rinvex\Categories\Models\Category as RinvexCategory;
use Spatie\MediaLibrary\InteractsWithMedia;

class Category extends RinvexCategory implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'slug'
    ];

    public function products(): MorphToMany
    {
        return $this->morphedByMany(
            Product::class,
            'categorizable',
            config('rinvex.categories.tables.categorizables'),
            'category_id',
            'categorizable_id',
            'id',
            'id'
        );
    }

    /*public array $translatedAttributes = ['slug', 'name', 'description'];

    protected $fillable = [
        'image',
        'parent_id',
        'one_c_id',
        'one_c_parent_id',
        'is_main',
        'icon',
        'position',
        'status'
    ];

    protected $casts = [
        'is_main' => 'boolean'
    ];

    // protected $with = [
    //     'translation'
    // ];

    public function scopeWhereSlug($query, $slug)
    {
        return $query->whereTranslation('slug', $slug);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'one_c_parent_id', 'one_c_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'one_c_parent_id', 'one_c_id');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'one_c_parent_id', 'one_c_id')->with([
            'childs' => fn ($query) => $query->active(),
            'translations'
        ]);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'one_c_parent_id', 'one_c_id');
    }

    public function getAllChildren(): Collection
    {
        $sections = collect();

        foreach ($this->children as $section) {
            $sections->push($section);
            $sections = $sections->merge($section->getAllChildren());
        }

        return $sections;
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'one_c_category_id', 'one_c_id');
    }

    public function pcCollect()
    {
        return $this->hasOne(PcCollect::class);
    }*/
}
