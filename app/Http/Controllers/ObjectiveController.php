<?php

namespace App\Http\Controllers;

use App\Models\Objective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ObjectiveController extends Controller
{

    public function change_permisos(Request $request) {
        $intervalo = $request->intervalo;
        if($intervalo == 'incial') {
            Objective::where('year', $request->year)->update(['start_lock' => !$request->value]);
        }
        else if($intervalo == 'final') {
            Objective::where('year', $request->year)->update(['end_lock' => !$request->value]);
        }

        return response()->json(['ok']);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $objectives = Objective::select('year', 'end_lock', 'start_lock')->orderBy('year', 'desc')->distinct()->get();
        return view('objectives.admin.index', compact('objectives'));        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('objectives.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function show(Objective $objective, Request $request, $txt)
    {
        if (($txt == "inicio" || $txt == "final") ) {
            $user = $request->user();
            // solo pueden ver los objetivos el mismo y sus jefes en line recta
            if ($objective->user_id == $user->id || $user->hierarchy($objective->user)  || $user->hasRole('Administrador')) {
                return view('objectives.show', compact('objective', 'txt'));
            }
            abort(403);
        } else {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Objective $objective, $txt)
    {
        $user = $request->user();



        if(!$objective->lock && ($user->id == $objective->user->boss->id || $user->id == $objective->user->id || $user->hasRole('Administrador'))) {
            switch ($txt) {

                case "inicio":
                    $title = "Objetivos iniciales";
                    break;
                case "final":
                    $title = "Objetivos finales";
                    break;
                default:
                    abort(404);
            }
            return view('objectives.edit', compact('title', 'objective', 'txt'));
        }
        abort(403);
        
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Objective $objective)
    {
        $request->validate([
            'objective' => 'required|mimes:pdf,application/pdf'
        ]);
        $txt = $request->txt;
        $path = Storage::putFile('objetivos', $request->file('objective'));
        $filename = $request->file('objective')->getClientOriginalName();
        switch ($txt) {
            case "inicio":
                $objective->start_path = $path;
                $objective->start_filename = $filename;
                $objective->start_comments = $request->comments;
                break;
            case "final":
                $objective->end_path = $path;
                $objective->end_filename = $filename;
                $objective->end_comments = $request->comments;
                break;
            default:
                abort(404);
        }
        $objective->save();
        return redirect(route('user.show', $request->user()). '?tab=objetivos')->with('success', 'Objetivos almacenados correctamente.');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Objective  $objective
     * @return \Illuminate\Http\Response
     */
    public function destroy(Objective $objective)
    {
    }

    public function show_pdf(Objective $objective, Request $request, $txt)
    {        
        $user = $request->user();
        // solo pueden ver los objetivos el mismo y sus jefes en linea recta
        if ($objective->user_id == $user->id || $user->hierarchy($objective->user) || $user->hasRole('Administrador')) {
            switch ($txt) {
                case "inicio":
                    return Storage::download($objective->start_path, $objective->start_filename, ["Content-Disposition" => "inline;"]);
                    break;
                case "final":
                    return Storage::download($objective->end_path, $objective->end_filename, ["Content-Disposition" => "inline;"]);
                    break;
                default:
                    abort(404);
            }
            
        }
        abort(404);
    }
}
