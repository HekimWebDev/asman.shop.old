<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = BlogPostComment::latest()
            ->with('posts', 'posts.translation', 'user')
            ->get();
        return view('admin.blog.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'blog_post_id' => 'required|integer',
            'message' => 'required|string',
        ]);

        BlogPostComment::create([
            'blog_post_id' => $request->blog_post_id,
            'message' => $request->message,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPostComment  $blogPostComment
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPostComment $blogPostComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPostComment  $blogPostComment
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPostComment $blogPostComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPostComment  $blogPostComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPostComment $blogPostComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPostComment  $blogPostComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPostComment $blogPostComment)
    {
        //
    }
}
