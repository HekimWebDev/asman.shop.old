<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $blogPosts = BlogPost::active()
            ->when(
                $request->q,
                fn($query) => $query->whereTranslationLike('name', '%' . $request->q . '%', $request->lang)
            )
            ->when(
                $request->offset,
                fn($query) => $query->skip($request->offset)
            )
            ->when(
                $request->limit,
                fn($query) => $query->take($request->limit)
            )
            ->latest()
            ->get();

        return BlogPostResource::collection($blogPosts)->additional([
            'result' => $blogPosts->count()
        ]);
    }
}
