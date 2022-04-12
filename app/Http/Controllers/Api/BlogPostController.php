<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $blogPosts = QueryBuilder::for(BlogPost::class)
            ->allowedSorts('created_at')
            ->allowedFilters([
                'id',
                AllowedFilter::scope('slug', 'whereSlug')
            ])
            ->active()
            ->with([
                'translations',
                'blogCategory.translations',
            ])
            ->take($request->limit)
            ->get();

        return response()->json(BlogPostResource::collection($blogPosts));
    }

    public function show(Request $request)
    {
        $blogPost = BlogPost::whereTranslation('slug', $request->slug)
            ->with('translations')
            ->firstOrFail();

        return response()->json(new BlogPostResource($blogPost));
    }
}
