<?php

namespace App\Http\Controllers\Web;

use App\Models\Models;
use App\Models\Chiller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChillerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('web.chiller.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Chiller::create($request->all());
        
        return redirect()->route('customer.profile')->with('success', 'Your request received successfully!');
    }
    
    /**
     * Get the specified resource in storage.
     */
    public function getModels(Request $request)
    {
        $data = Models::whereBrandId($request->id)->get();
        echo json_encode($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
