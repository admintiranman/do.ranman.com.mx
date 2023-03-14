<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subsummary;
use App\Models\Summary;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
    public function create(Subsummary $subsummary)
    {
        return view('question.create', compact('subsummary'));

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subsummary $subsummary)
    {
        $request->validate([
            'text' => 'required'
        ]);
        Question::create(['text' => $request->text, 'subsummary_id' => $subsummary->id]);
        return redirect()->route('survey.edit', [$subsummary->summary->survey])->with('success','Pregunta Agregada Correctamente');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Subsummary $subsummary, Question $question)
    {
        return view("question.edit", compact("question", "subsummary"));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsummary $subsummary, Question $question)
    {
        $request->validate([
            'text' => 'required'
        ]);
        $question->update($request->all());        
        return redirect()->route('survey.edit', [$subsummary->summary->survey])->with('success','Pregunta actualizada correctamente');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsummary $subsummary, Question $question)
    {
        $question->delete();
        return redirect()->route('survey.edit', [$subsummary->summary->survey])->with('success','Pregunta actualizada correctamente');
    }
}
