<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model implements TranslatableContract
{
    use HasFactory, Translatable;

    public $translatedAttributes = ['slug', 'name', 'description'];

    protected $fillable = [
        'blog_category_id',
        'image',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeWhereSlug($query, $slug)
    {
        return $query->whereTranslation('slug', $slug);
    }

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class)->withDefault();
    }

    public function blogTags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_post_tag', 'blog_post_id', 'blog_tag_id');
    }

    public function blogComments()
    {
        return $this->hasMany(BlogPostComment::class, 'blog_post_id', 'id');
    }
}
