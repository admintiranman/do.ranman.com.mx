<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Option;


class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Survey $survey)
    {
        return view('summary.create', compact('survey'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Survey $survey)
    {
        $request->validate([
            'text' => 'required'
        ]);        
        $summary = Summary::create(['text' => $request->text, 'survey_id' => $survey->id]);
        for($i = 0; $i < count($request->option); $i++) { 
            Option::create([ 'summary_id' => $summary->id, 'text' => $request->option[$i], 'color' => $request->color[$i], 'value' => $request->value[$i]]);
        }        
        return redirect()->route('survey.edit', [$survey])->with('success', 'Seccion Agregada Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function show(Summary $summary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function edit(Summary $summary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Summary $summary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey, Summary $summary)
    {
        $summary->delete();
        return redirect()->route('survey.show', [$survey])->with('success', 'sección eliminada correctamente');

        //
    }
}
