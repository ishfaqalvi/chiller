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
            $response =['state' => 'warning','message' => 'Your email is already exist!'];
        }else{
            $newsletter = Newsletter::create($request->all());
            $response =['state' => 'success','message' => 'Your email is added successfully!'];
        }
        return response()->json($response);
    }
}
