<?php

namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Http\Controllers\Controller;

/**
 * Class BlogController
 * @package App\Http\Controllers
 */
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();

        return view('web.blog.index', compact('blogs'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $blog = Blog::find($id);
        // Previous Blog
        $previousBlog = Blog::where('id', '<', $id)->orderBy('id', 'desc')->first();

        // Next Blog
        $nextBlog = Blog::where('id', '>', $id)->orderBy('id', 'asc')->first();

        // Latest 2 blogs
        $latestBlogs = Blog::orderBy('created_at', 'desc')->take(2)->get();

        return view('web.blog.show', compact('blog','previousBlog','nextBlog','latestBlogs'));
    }
}
