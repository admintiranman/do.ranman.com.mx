<?php

namespace App\Http\Controllers;

use App\Models\Retroalimentacion;
use Illuminate\Http\Request;
use App\Models\Profile;

class RetroalimentacionController extends Controller
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
        return view('retro.create');        
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
     * @param  \App\Models\Retroalimentacion  $retroalimentacion
     * @return \Illuminate\Http\Response
     */
    public function show(Retroalimentacion $retroalimentacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retroalimentacion  $retroalimentacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = $request->user();
        $retro = Retroalimentacion::find($id);
        if ($user->id == $retro->user->boss->id) {
            return view('retro.edit', compact('retro'));
        }
        else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Retroalimentacion  $retroalimentacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retroalimentacion $retroalimentacion)
    {
        $retroalimentacion->respuesta1 = $request->respuesta1??'';
        $retroalimentacion->respuesta2 = $request->respuesta2??'';
        $retroalimentacion->avance = (($request->respuesta1? 50 : 0) + ($request->respuesta2?50 : 0));
        $retroalimentacion->save();
    
        return redirect(route('user.show', $request->user()) . '?tab=team')->with('success', 'Retroalimentación guardada correctamente.');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retroalimentacion  $retroalimentacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retroalimentacion $retroalimentacion)
    {
        //
    }
}
