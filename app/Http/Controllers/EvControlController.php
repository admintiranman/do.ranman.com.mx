<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Survey;
use App\Models\Level;
use App\Models\EvControl;
use App\Models\Retroalimentacion;
use App\Models\EvaluacionPerfil;
use App\Models\Objective;
use App\Models\PlanDesarrolloIndividual;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class EvControlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluations = EvControl::latest()->get();         
        return view('evaluations.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $options = User::where('name', '<>', 'vacante')
            ->select('name', 'id')
            ->orderBy('name', 'asc')
            ->get();
        return view('evaluations.create', compact("options"));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $users = [];
        if(!isset($data['users'])) {
            return redirect()->route('admin.evaluaciones.index')->with('error', 'No fue posible crear la evaluación.');
        }
        foreach($data["users"] as $u) {
            switch($u) { 
                // Directores
                case -1:
                    $array = Level::where("name", "Dirección")
                                ->first()
                                ->users
                                ->pluck("id")
                                ->all();
                    break;
                // Gerentes
                case -2:
                    $array = Level::where("name", "Gerencia")
                                ->first()
                                ->users
                                ->pluck("id")
                                ->all();
                    break;
                // Coordinadores
                case -3:
                    $array = Level::where("name", "Coordinación")
                                ->first()
                                ->users
                                ->pluck("id")
                                ->all();                    
                    break;
                // Especialistas
                case -4:
                    $array = Level::where("name", "Especialista")
                                ->first()
                                ->users
                                ->pluck("id")
                                ->all();
                    break;
                // Soporte Administrativo
                case -5:
                    $array = Level::where("name", "Soporte Administrativo")
                                ->first()
                                ->users
                                ->pluck("id")
                                ->all();
                    break;
                default:
                    $array = [$u];
            }
            $users = array_merge($users, $array);;
        }

        $users = array_unique($users);

        DB::beginTransaction();
        try {
            $control = EvControl::create(["name" => $request->name, "description" => $request->description]);
            
            $objetivos = isset($request->objetivos);
            $objetivos_year = $request->objetivos_year ?? date('Y');    
            $edp = isset($request->edp);
            $retro = isset($request->retro);
            $pdi = isset($request->pdi);
            foreach($users as $user_id) {
                $user = User::find($user_id);
                if(!$user) {
                    continue;
                }
                $this->addUserToControl($control->id, $user, $objetivos, $objetivos_year, $edp, $retro, $pdi);
            }
            
            DB::commit();
        }
        catch(Exception $ex) {            
            DB::rollBack();
            return redirect()->route("admin.evaluaciones.index")->with("error", "Ocurrio un error al generar las evaluaciones");
        }
        
        $count = count($users);
        return redirect()->route('admin.evaluaciones.index')->with('success', "Se agregó la evaluación a  $count colaboradores.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EvControl  $evControl
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        
        
        $evControl = EvControl::findOrFail($id);                  
        $participantes = $evControl->participantes()->get();
        $users = User::where('name', '<>', 'vacante')
                    ->whereNotIn('id', $evControl->participantes()->pluck('user_id')->all())
                    ->select('name', 'id')
                    ->orderBy('name', 'asc')
                    ->get();    
        $users = json_encode($users);
        return view('ev_control.show', compact('evControl', 'participantes', 'users'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EvControl  $evControl
     * @return \Illuminate\Http\Response
     */
    public function edit(EvControl $evControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EvControl  $evControl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ev = EvControl::findOrFail($id);
        $ev->update(
            [
                'lock_objectives' => $request->lock_objectives??0,
                'lock_ev_perfil' => $request->lock_ev_perfil??0,
                'lock_ev_dp' => $request->lock_ev_dp??0,
                'lock_retro' => $request->lock_retro??0,
                'lock_pdi' => $request->lock_pdi??0,
            ]
        );

        

        Objective::where('ev_control_id', $id)->update(['start_lock' => $request->lock_objectives??0, 'end_lock' => $request->lock_objectives??0]);
        EvaluacionPerfil::where('ev_control_id', $id)->update(['lock' => $request->lock_ev_perfil??0]);
        Evaluation::where('ev_control_id', $id)->update(['lock' => $request->lock_ev_dp??0]);
        Retroalimentacion::where('ev_control_id', $id)->update(['lock' => $request->lock_retro??0]);
        PlanDesarrolloIndividual::where('ev_control_id', $id)->update(['lock' => $request->lock_pdi??0]);
        return redirect()->route('admin.evaluaciones.show', $id)->with('success', 'Control de evaluación Guardado');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EvControl  $evControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvControl $evControl)
    {
        //
    }


    public function addUser(Request $request, $id) {

        $user = User::where('name', $request->username)->first();
        $evControl = EvControl::find($id);
        if($user){ 
            $objetivos = false;
            $objetivos_year= 0;
            $edp = $evControl->evaluations->count()>0;
            $retro = $evControl->retroalimentaciones->count()>0;
            $pdi = $evControl->pdi->count() >0;
            $objetivos = $evControl->objectives->count() > 0;
            
            if($objetivos) { 
                $objetivos_year = $evControl->objectives->first()->year;
            }

            $this->addUserToControl($evControl->id, $user, $objetivos, $objetivos_year, $edp, $retro, $pdi);        
        }



        return redirect()->route('admin.evaluaciones.show', $id)->with(['success' => 'Usuario agregado correctamente']);
    }

    public function refresh_evaluation($id) {
        $contol = EvControl::find($id);
        if(!$contol->refresh_evaluations()) {
            return redirect()->route('admin.evaluaciones.show', $id)->with(['error' => 'Ocurrio un error al actualizar las encuestas']);     
        }
        return redirect()->route('admin.evaluaciones.show', $id)->with(['success' => 'Encuestas actualizadas correctamente']);
    }



    protected function addUserToControl($control_id, $user, $objetivos, $objetivos_year ,$evaluacion, $retro, $pdi ) {

        // objetivos 
        if ($objetivos) {                
            Objective::create([
                'ev_control_id' => $control_id,
                'year' => $objetivos_year,
                'user_id' => $user->id,
            ]);
        } 
        
        if ($evaluacion) {

            
            $survey = Survey::with('summaries.options', 'summaries.subsummaries.questions')
                        ->where("level_id", $user->level->id)
                        ->where("enabled", true)           
                        ->orderBy('id', 'desc')             
                        ->first();
            $survey_json = json_encode($survey->summaries);
            $current_section = $survey->summaries[0]->text;
                                
            Evaluation::create([
                'user_id' => $user->id,
                'ev_control_id' => $control_id,                        
                'name_survey' => $survey->name,
                'description_survey' => "",
                'survey' => $survey_json,
                'current_section' => $current_section,
            ]);
        } 

        if ($retro) {
            // retroalimentacion
            Retroalimentacion::create([
                'ev_control_id' => $control_id,
                'user_id' => $user->id,
                
            ]);        
        } 
        // planes de desarrollo
        if ($pdi) {                
            PlanDesarrolloIndividual::create([
                'ev_control_id' => $control_id,
                'user_id' => $user->id,                        
                'body' => json_encode([])
            ]);                    
        }   
    }
}