<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\ProjectDetail;
use Illuminate\Http\Request;

/**
 * Class ProjectDetailController
 * @package App\Http\Controllers
 */
class ProjectDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:projectDetails-list',  ['only' => ['index']]);
        $this->middleware('permission:projectDetails-view',  ['only' => ['show']]);
        $this->middleware('permission:projectDetails-create',['only' => ['create','store']]);
        $this->middleware('permission:projectDetails-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:projectDetails-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectDetails = ProjectDetail::get();

        return view('admin.project-detail.index', compact('projectDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projectDetail = new ProjectDetail();
        return view('admin.project-detail.create', compact('projectDetail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $projectDetail = ProjectDetail::create($request->all());
        return redirect()->route('project-details.index')
            ->with('success', 'ProjectDetail created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectDetail = ProjectDetail::find($id);

        return view('admin.project-detail.show', compact('projectDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectDetail = ProjectDetail::find($id);

        return view('admin.project-detail.edit', compact('projectDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ProjectDetail $projectDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectDetail $projectDetail)
    {
        $projectDetail->update($request->all());

        return redirect()->route('project-details.index')
            ->with('success', 'ProjectDetail updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectDetail = ProjectDetail::find($id)->delete();

        return redirect()->route('project-details.index')
            ->with('success', 'ProjectDetail deleted successfully');
    }
}
