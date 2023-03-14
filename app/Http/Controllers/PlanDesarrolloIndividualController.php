<?php

namespace App\Http\Controllers;

use App\Models\PlanDesarrolloIndividual;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanDesarrolloIndividualController extends Controller
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
    public function create(Profile $profile)
    {
        return view('pdi.create', compact('profile'));                
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Profile $profile)
    {                
        $request->validate([
            'nombre' => 'required',
            'puesto' => 'required',
            'udn' => 'required', 
            'jefe_inmediato' => 'required',
            'departamento' => 'required',
        ]);

        $pdi = PlanDesarrolloIndividual::create([
            'perfil_id' => $profile->id,
            'nombre' => $request->nombre, 
            'puesto' => $request->puesto, 
            'udn' => $request->udn,
            'jefe_inmediato' => $request->jefe_inmediato,
            'departamento' => $request->departamento,
            'comentarios' => $request->comentarios,
        ]);
        return redirect()->route('profile.show', $profile)->with('success', 'Plan de desarrollo individual creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlanDesarrolloIndividual  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlanDesarrolloIndividual  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pdi = PlanDesarrolloIndividual::find($id);
        return view('pdi.edit', compact('pdi'));        
    }


    public function update(Request $request, $id)
    {
        $pdi = PlanDesarrolloIndividual::find($id);
        if($pdi) { 
            if($request->sign==true) {
                if($request->user()->id == $pdi->user->boss->id)  {
                    $pdi->sign_boss =  $pdi->boss;
                    $pdi->sign_boss_datetime = date('Y-m-d H:i:s');                    
                }
                if($request->user()->id == $pdi->user_id)  {
                    $pdi->sign_employee =  $pdi->employee_name;
                    $pdi->sign_employee_datetime = date('Y-m-d H:i:s');   
                    $pdi->avance = 50;
                }
            }
            else {
                $pdi->body = json_encode($request->body);                
                $pdi->comentarios = $request->comentarios;
                $pdi->avance = $request->isComplete ? 100 : 50;
            }
            $pdi->save();
        }
        return response()->json([
            'message' => 'ok'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlanDesarrolloIndividual  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function sign()
    {

    }
}
