<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use App\Models\Contact;
use Illuminate\Http\Request;

/**
 * Class ContactController
 * @package App\Http\Controllers
 */
class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Contact::create($request->all());
        return redirect()->route('home')
        ->with('success', 'Your message has been sent successfully!');
    }
}
