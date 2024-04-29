<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Models;
use Illuminate\Http\Request;

/**
 * Class ModelController
 * @package App\Http\Controllers
 */
class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:models-list',  ['only' => ['index']]);
        $this->middleware('permission:models-view',  ['only' => ['show']]);
        $this->middleware('permission:models-create',['only' => ['create','store']]);
        $this->middleware('permission:models-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:models-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Models::get();

        return view('admin.model.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Models();
        return view('admin.model.create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = Models::create($request->all());
        return redirect()->route('models.index')
            ->with('success', 'Model created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Models::find($id);

        return view('admin.model.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Models::find($id);

        return view('admin.model.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Models $model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Models $model)
    {
        $model->update($request->all());

        return redirect()->route('models.index')
            ->with('success', 'Model updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $model = Models::find($id)->delete();

        return redirect()->route('models.index')
            ->with('success', 'Model deleted successfully');
    }
}
