<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Retroalimentacion;
use Illuminate\Support\Facades\Auth;


class EvaluationResponseController extends Controller
{

    public function index() {

        $ids = Auth::user()->team()->pluck('id')->all();
        $evaluations = Evaluation::whereIn('user_id', $ids)->get();
        return view('evaluations.response.index', compact('evaluations'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $uuid) {
        $evaluation = Evaluation::where('uuid', $uuid)->first();    
        if($evaluation) { 
            $section = $request->query('section')??$evaluation->current_section;        
            return view('evaluations.response.edit', compact('evaluation', 'section'));
        }   
        abort(404); 
    }

    
    public function update(Request $request, $uuid) 
    {
        $evaluation = Evaluation::where('uuid',$uuid)->first();
        $next_url = null;
        if($evaluation) {
            $evaluation->survey = json_encode($request->survey);
            $evaluation->status = 'in progress';
            if($request->is_complete) { 
                $evaluation->current_section = $request->next_section;
                if($request->next_section == null) {
                    $evaluation->status = 'close';
                    $evaluation->current_section = 'METAS';
                    $evaluation->resultados();      

                    $retro = Retroalimentacion::where('user_id', $evaluation->user_id)
                            ->where('ev_control_id', $evaluation->ev_control_id)
                            ->first();

                    $next_url = $retro ? route('retro.edit', $retro->id) : route('user.show', $evaluation->user->boss->id);
                }
            }            
            $evaluation->save();
        }
        return response()->json(['message' => 'ok', 'next' => $next_url]);
    }
}
