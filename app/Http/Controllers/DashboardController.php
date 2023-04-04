<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objective;
use App\Models\Evaluation;
use App\Models\EvControl;
use App\Models\PlanDesarrolloIndividual;
use App\Models\Retroalimentacion;


class DashboardController extends Controller
{
    //


    public function get(Request $request)
    {
        if(isset($request->control)) { 
            $control = EvControl::find($request->control);
        }
        else {
            $control = EvControl::latest()->first(); 
        }

        $options_control = $control ? EvControl::where("id", "<>", $control->id)->get() : [];
        // dd(compact("control", "options_control"));
        return view(
            'admin.dashboard.index',
            compact(
                'control',
                'options_control'
            )
        );
    }



    public function objectives(Request $request)
    {
        if(isset($request->control)) { 
            $control = EvControl::find($request->control);
        }
        else {
            $control = EvControl::latest()->first();
        }

        $objectives = $control->objectives()->where(function ($query) { 
            $query->whereNotNull('start_path')
            ->orWhereNotNull('end_path');
        })        
        ->orderBy("employee_name", "asc")
        ->get();        
        return view('admin.dashboard.objectives', compact('objectives', 'control'));
    }


    public function retro(Request $request)
    {
        if(isset($request->control)) { 
            $control = EvControl::find($request->control);
        }
        else {
            $control = EvControl::latest()->first();
        }

        $retro = $control->retroalimentaciones()
            ->where('respuesta1', '<>', '')
            ->Where('respuesta2', '<>', '')            
            ->orderBy('employee_name', 'asc')
            ->get();
        return view('admin.dashboard.retro', compact('retro', 'control'));
    }



    public function evaluaciones(Request $request)
    {
        if(isset($request->control)) { 
            $control = EvControl::find($request->control);
        }
        else {
            $control = EvControl::latest()->first();
        }
        $evaluaciones = $control->evaluations()->where('y_potencial', '<>', 0)->orderBy('employee_name', 'asc')->get();
        return view('admin.dashboard.evaluaciones', compact('evaluaciones', 'control'));
    }


    public function ev_show($uuid)
    {

        $ev = Evaluation::where('uuid', $uuid)->first();
        if ($ev) {
            return view('admin.dashboard.ev.show', compact('ev'));
        }
        abort(404);
    }


    public function pdi(Request $request)
    {
        if(isset($request->control)) { 
            $control = EvControl::find($request->control);
        }
        else {
            $control = EvControl::latest()->first();
        }
        $pdi = $control->pdi()->where('avance', '<>', 0)->orderBy('nombre', 'asc')->get();        
        return view('admin.dashboard.pdi.index', compact('pdi', 'control'));
    }


    public function pdi_show($id)
    {
        $pdi = PlanDesarrolloIndividual::find($id);
        if ($pdi) {
            return view('admin.dashboard.pdi.show', compact('pdi'));
        }
        abort(404);
    }
}
