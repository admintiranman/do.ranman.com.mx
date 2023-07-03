<?php

namespace App\Http\Controllers;

use App\Models\Subsummary;
use App\Models\Summary;
use App\Models\Survey;
use Illuminate\Http\Request;

class SubsummaryController extends Controller
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
    public function create(Survey $survey, Summary $summary)
    {
        return view('subsummary.create', compact('survey', 'summary'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Survey $survey, Summary $summary)
    {
        $request->validate([
            'text' => 'required'
        ]);
        $subsummary = Subsummary::create(['text' => $request->text, 'summary_id' => $summary->id]);
        //
        return redirect()->route('survey.edit', [$survey])->with('success', 'Subtema agragado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subsummary  $subsummary
     * @return \Illuminate\Http\Response
     */
    public function show(Subsummary $subsummary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subsummary  $subsummary
     * @return \Illuminate\Http\Response
     */
    public function edit(Subsummary $subsummary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subsummary  $subsummary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsummary $subsummary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subsummary  $subsummary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey, Summary $summary, Subsummary $subsummary)
    {
        $subsummary->delete();
        return redirect()->route('survey.edit', [$survey])->with('success', 'Subtema eliminado correctamente');

    }
}
