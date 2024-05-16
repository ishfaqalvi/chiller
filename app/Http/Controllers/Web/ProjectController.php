<?php

namespace App\Http\Controllers\Web;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Writer\Pdf;
use \Mpdf\Mpdf;

class ProjectController extends Controller
{
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
        $data = $this->calculateResult($id);
        $html = view('web.project.show', $data)->render();

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

    /**
     * Calculate the results.
     */
    public function calculateResult($id)
    {
        $project = Project::find($id);
        $chillers = [];
        foreach($project->details as $row)
        {
            $chillers[] = [
                'make_model'   => $row->chiller->model->name,
                'max_capacity' => $row->chiller_maximum_capacity,
                'min_capacity' => $row->chiller_minimum_capacity,
                'water_flow'   => $row->chilled_water_flow,
                'iplv_25'      => $row->partial_load_25,
                'iplv_50'      => $row->partial_load_50,
                'iplv_75'      => $row->partial_load_75,
                'iplv_100'     => $row->partial_load_100,
            ];
        }
        $data = [
            'project_number'    => $project->project_number,
            'project_data'      => $project->created_at,
            'project_customer'  => $project->customer->first_name.' '.$project->customer->last_name,
            'building_min_load' => $project->building_minimum_load,
            'building_max_load' => $project->building_maximum_load,
            'water_differential'=> $project->chilled_water_differential,
            'chillers'          => $chillers,
            'load_steps' => [
                ['step' => 0, 'upper_bound' => 0, 'chillers' => ['OFF', 'OFF']],
                ['step' => 1, 'upper_bound' => 100, 'chillers' => ['ON', 'OFF']],
                // Add more steps as needed
            ],
        ];
        return $data;
    }
}
