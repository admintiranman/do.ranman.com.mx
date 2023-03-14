<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Survey;
use App\Models\Level;
use App\Models\Retroalimentacion;
use App\Models\EvaluacionPerfil;
use App\Models\Objective;
use App\Models\PlanDesarrolloIndividual;


class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluations = Evaluation::latest()->get();
        return view('evaluations.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Survey::orderBy('name', 'asc')->get();
        $levels = Level::orderBy('name', 'asc')->get();
        return view('evaluations.create', compact('templates', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // $level = Level::find($request->level_id);
        // $survey = Survey::find($request->survey_id)
        //     ->with('summaries.options', 'summaries.subsummaries.questions')
        //     ->first();
        // $survey_json = json_encode($survey->summaries);
        // $current_section = $survey->summaries[0]->text;

        // foreach ($level->profiles()->get() as $p) {


        //     /* Objetivos */

        //     Objective::create([
        //         'year' => 2022,
        //         'employee_name' => $p->user->name,
        //         'profile_id' => $p->id,
        //         'start_lock' => false,
        //         'end_lock' => false
        //     ]);
            

        //     // evaluacion de perfil
        //     // EvaluacionPerfil::create(
        //     //     [
        //     //         'profile_id' => $p->id,
        //     //         'level' => $level->name,
        //     //         'employee_name' => $p->user->name,
        //     //         'job_name' => $p->job->name,
        //     //         'current_section' => 'Competencias culturales',
        //     //         'evaluacion' => json_encode([
        //     //             [
        //     //                 'section' => 'Competencias culturales', 
        //     //                 'data' => $p->job->core_competencies()->select('name')->selectRaw('0 as value')->get()->all(), 
        //     //             ],
        //     //             [
        //     //                 'section' => 'Competencias del puesto', 
        //     //                 'data' => $p->job->job_competencies()->select('name')->selectRaw('0 as value')->get()->all(), 
        //     //             ],
        //     //             [
        //     //                 'section' => 'Conocimientos', 
        //     //                 'data' => $p->job->knowledge()->select('name')->selectRaw('0 as value')->get()->all(), 
        //     //             ]
        //     //         ])
        //     //     ]
        //     // );

        //     // crea las evaluaciones
        //     Evaluation::create([
        //         'profile_id' => $p->id,
        //         'level' => $level->name,
        //         'employee_name' => $p->user->name,
        //         'job_name' => $p->job->name,
        //         'name_survey' => $request->name,
        //         'description_survey' => $request->description,
        //         'survey' => $survey_json,
        //         'current_section' => $current_section,
        //     ]);
        //     // retroalimentacion
        //     Retroalimentacion::create([
        //         'profile_id' => $p->id,
        //         'level' => $level->name,
        //         'employee_name' => $p->user->name,
        //         'job_name' => $p->job->name,
        //     ]);
        //     // planes de desarrollo
        //     PlanDesarrolloIndividual::create([
        //         'perfil_id' => $p->id,
        //         'nombre' => $p->user->name, 
        //         'puesto' => $p->job->name,                  
        //         'udn' => $p->udn->name,
        //         'jefe_inmediato' => $p->boss->user->name,
        //         'comentarios' => ''
        //     ]);
        //     // 
        // }
        // $count = $level->profiles()->count();
        // return redirect()->route('admin.evaluations.index')->with('success', "Se agregó la evaluación a  $count colaboradores.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
