<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{


    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = $this->arrary_to_matriz(Survey::orderBy('name')->get());
        return view('survey.index', compact('surveys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $levels = Level::where("name", "<>" ,"N/A")->orderBy("id", "asc")->get();
        return view('survey.create', compact('levels'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:surveys',
            'level_id' => 'required',
            'description' => 'nullable'
        ]);
        $survey = Survey::create([
            'name' => $request->name,
            'level_id' => $request->level_id,
            'description' => $request->description
        ]);

        return redirect()->route('survey.edit', $survey)->with('success', 'Encuesta creada correctamente');               
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        $survey = Survey::where('id', $survey->id)->with('summaries.options', 'summaries.subsummaries.questions')->first();        
        return view('survey.show', compact('survey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        return view('survey.edit', compact('survey'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->route('survey.index')->with('success', 'Encuesta eliminada correctamente');        
    }


    public function get_clonar(Survey $survey) {
        $levels = \App\Models\Level::orderBy('name')->get();
        return view('survey.clonar', compact('survey', 'levels'));
    }


    public function clonar(Request $request, Survey $survey) {

        $request->validate([
            'name' => 'required|unique:surveys',
            'level_id' => 'required',
            'description' => 'nullable'
        ]);
        $clone = $survey->clone($request->name, $request->description , $request->level_id);        
        return redirect()->route('survey.edit', $clone)->with('success', 'Encuesta creada correctamente');
    }
}
