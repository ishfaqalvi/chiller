<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use App\Models\Newsletter;
use Illuminate\Http\Request;

/**
 * Class NewsletterController
 * @package App\Http\Controllers
 */
class NewsletterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check = Newsletter::whereEmail($request->email)->first();
        if ($check) {
            return redirect()->route('home')->with('warning','Your email is already exist!');
        }
        Newsletter::create($request->all());
        return redirect()->route('home')->with('success','Your email is added successfully!');
    }
}
