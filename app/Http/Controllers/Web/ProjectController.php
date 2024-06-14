<?php

namespace App\Http\Controllers\Web;

use \Mpdf\Mpdf;
use App\Models\Chiller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Interface\ChillerCalculationInterface;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class ProjectController extends Controller
{
    protected $chillerCalculation;

    public function __construct(ChillerCalculationInterface $chillerCalculation){
        $this->chillerCalculation = $chillerCalculation;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Auth::guard('customers')->user()->projects;
        return view('web.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $chiller = !empty($request->session()->get('numberOfChillers')) ? $request->session()->get('numberOfChillers') : 2;

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
     * Display the specified resource.
     */
    public function calculate($id)
    {
        $data = $this->chillerCalculation->calculation($id);

        $html = view('web.project.calculate', $data)->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('project_report.pdf', 'I');
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
