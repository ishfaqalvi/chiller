<?php

namespace App\Http\Controllers\Web;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.project.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $chiller = !empty($request->session()->get('numberOfChillers')) ? $request->session()->get('numberOfChillers') : 1;

        return view('web.project.create', compact('chiller'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $project = auth('customers')->user()->projects()->create($input);
        foreach($input['chiller_id'] as $key => $chiller){
            $project->details()->create([
                'chiller_id'                => $chiller,
                'chiller_maximum_capacity'  => $input['chiller_maximum_capacity'][$key],
                'chiller_minimum_capacity'  => $input['chiller_minimum_capacity'][$key],
                'chilled_water_flow'        => $input['chilled_water_flow'][$key],
                'partial_load_25'           => $input['partial_load_25'][$key],
                'partial_load_50'           => $input['partial_load_50'][$key],
                'partial_load_75'           => $input['partial_load_75'][$key],
                'partial_load_100'          => $input['partial_load_100'][$key],
            ]);
        }
        return redirect()->route('project.show', $project->id)
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('web.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function setChiller(Request $request)
    {
        $request->session()->put('numberOfChillers', $request->number);

        return response()->json(['message' => 'Chiller selected successfully!']);
    }
}
