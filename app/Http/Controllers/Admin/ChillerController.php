<?php

namespace App\Http\Controllers\Admin;
use App\Models\Models;

use App\Models\Chiller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Class ChillerController
 * @package App\Http\Controllers
 */
class ChillerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:chillers-list',  ['only' => ['index']]);
        $this->middleware('permission:chillers-view',  ['only' => ['show']]);
        $this->middleware('permission:chillers-create',['only' => ['create','store']]);
        $this->middleware('permission:chillers-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:chillers-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chillers = Chiller::get();

        return view('admin.chiller.index', compact('chillers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $chiller = new Chiller();
        return view('admin.chiller.create', compact('chiller'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $chiller = Chiller::create($request->all());
        return redirect()->route('chillers.index')
            ->with('success', 'Chiller created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chiller = Chiller::find($id);

        return view('admin.chiller.show', compact('chiller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chiller = Chiller::find($id);

        return view('admin.chiller.edit', compact('chiller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Chiller $chiller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chiller $chiller)
    {
        $chiller->update($request->all());

        return redirect()->route('chillers.index')
            ->with('success', 'Chiller updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $chiller = Chiller::find($id)->delete();

        return redirect()->route('chillers.index')
            ->with('success', 'Chiller deleted successfully');
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
     * Get the specified resource in storage.
     */
    public function validFormula(Request $request)
    {
        $expression = str_replace('x', 1, $request->formula);
        try {
            $language = new ExpressionLanguage();
            $language->evaluate($expression);
            echo "true";
        } catch (\Exception $e) {
            echo "false";
        }
    }
}
