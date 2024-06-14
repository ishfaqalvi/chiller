<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->take(2)->get();
        return view('web.pages.home', compact('blogs'));
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function privacyPolicy()
    {
        return view('web.pages.privacy-policy');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function termsOfService()
    {
        return view('web.pages.terms-of-service');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function agreement()
    {
        return view('web.pages.agreement');
    }
}
