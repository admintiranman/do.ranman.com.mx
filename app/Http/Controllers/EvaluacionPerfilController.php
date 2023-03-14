<?php

namespace App\Http\Controllers;

use App\Models\EvaluacionPerfil;
use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluacionPerfilController extends Controller
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
    public function create()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EvaluacionPerfil  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EvaluacionPerfil  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $uuid)
    {
        $ev = EvaluacionPerfil::where('uuid', $uuid)->first();
        $section = $request->query('section')??$ev->current_section;        
        return view('ev_perfil.edit', compact('ev', 'section'));
        // return response()->json(['ad' => $ev]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EvaluacionPerfil  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $ev = EvaluacionPerfil::where('uuid', $uuid)->first();
        $ev->evaluacion = json_encode($request->evaluacion);
        $ev->status = 'In-Progress';
        $next = null;
        if($request->is_complete) { 
            $ev->current_section = $request->next_section;
            if($request->next_section == null) {
                $ev->status = 'close';
                $ev->current_section = 'Competencias culturales';
                $last = Evaluation::where('user_id', $ev->user_id)->latest()->first();
                $next = route('evaluacion.edit', $last->uuid);
            }
        }
        $ev->save();
        return response()->json(['message' => 'ok', 'next' => $next]);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EvaluacionPerfil  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        //
    }
}
