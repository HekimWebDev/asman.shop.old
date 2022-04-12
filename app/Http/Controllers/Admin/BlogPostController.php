<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogPostTranslation;
use App\Models\BlogTag;
use App\Traits\ImageUpload;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    use ImageUpload;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogPosts = BlogPost::latest()
            ->with([
                'translation',
                'blogCategory.translation',
                'blogTags'
            ])
            ->withCount('blogComments')
            ->get();

        return view('admin.blog.posts.index', compact('blogPosts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogCategories = BlogCategory::with('translation')
            ->get();
        return view('admin.blog.posts.create', compact('blogCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
                '%description%' => 'required|string',
            ])
        );
        $request->validate([
            'blog_category_id' => 'required',
            'image' => 'required|mimes:png,jpg,webp',
            'status' => 'boolean',
            'tags.*' => 'required',
        ]);

        $blogPost = BlogPost::create($request->post());

        $blogPost->status = $request->status === null ? 0 : $request->status;

        $blogTags = collect();
        foreach ($request->tags as $tag) {
            $blogTag = BlogTag::firstOrCreate([
                'name' => $tag
            ]);
            $blogTags->push($blogTag->id);
        }

        $blogPost->blogTags()->sync($blogTags);

        if ($request->file('image')) {
            $blogPost->image = $this->storeImage($request->file('image'), 'posts');
            $blogPost->save();
        }

        $blogPost->save();

        return redirect()->route('admin.blog.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $post)
    {
        $blogCategories = BlogCategory::with('translation')
            ->get();
        return view('admin.blog.posts.edit', compact('post', 'blogCategories'))->with('tags');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $post)
    {
        $request->validate(
            RuleFactory::make([
                '%name%' => 'required|string',
                '%description%' => 'required|string',
            ])
        );

        $request->validate([
            'blog_category_id' => 'required',
            'image' => 'nullable|mimes:png,jpg,webp',
            'status' => 'boolean',
            'tags.*' => 'required',
        ]);

        $post->update($request->post());
        $post->status = $request->status === null ? 0 : $request->status;

        $blogTags = collect();
        foreach ($request->tags as $tag) {
            $blogTag = BlogTag::firstOrCreate([
                'name' => $tag
            ]);
            $blogTags->push($blogTag->id);
        }

        $post->blogTags()->sync($blogTags);

        if ($request->file('image')) {
            $this->destroyImage($post->image);
            $post->image = $this->storeImage($request->file('image'), 'posts');
            $post->save();
        }

        $post->save();

        return redirect()->route('admin.blog.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $post)
    {
        $this->destroyImage($post->image);
        $post->delete();
        return redirect()->back();
    }
}
