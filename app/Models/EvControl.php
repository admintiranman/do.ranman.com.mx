<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EvControl extends Model
{
    use HasFactory;

    protected $fillable = [        
        'name', 
        'description', 
        'lock_objectives', 
        'lock_ev_perfil', 
        'lock_ev_dp', 
        'lock_retro',
        'lock_pdi'
    ];

    protected $casts = [        
        'lock_objectives' => 'boolean',
        'lock_ev_perfil' => 'boolean',
        'lock_ev_dp' => 'boolean',
        'lock_retro' => 'boolean',
        'lock_pdi' => 'boolean',
    ];


    public function objectives() {
        return $this->hasMany(Objective::class);
    }

    public function evaluations() {
        return $this->hasMany(Evaluation::class);
    }

    public function retroalimentaciones() {
        return $this->hasMany(Retroalimentacion::class);
    }

    public function pdi() {
        return $this->hasMany(PlanDesarrolloIndividual::class);
    }


    public function refresh_evaluations() { 

        DB::beginTransaction();
        try {

            $this->evaluations()->where('y_potencial', '<>', 0)->delete();            
            $users  = User::where('report_id', '<>', 0)
                        ->whereNotNull('report_to')
                        ->whereNotIn('id', $this->evaluations()->pluck('user_id')->all())
                        ->get();

            foreach($users as $user) { 

                $survey = Survey::with('summaries.options', 'summaries.subsummaries.questions')
                        ->where("level_id", $user->level->id)
                        ->where("enabled", true)         
                        ->orderBy('id', 'desc')               
                        ->first();
                if(!isset($survey)) {
                    continue;
                }
                $survey_json = json_encode($survey->summaries);
                $current_section = $survey->summaries[0]->text;
                                
                $ev =Evaluation::create([
                    'user_id' => $user->id,
                    'ev_control_id' => $this->id,                        
                    'name_survey' => $survey->name,
                    'description_survey' => "",
                    'survey' => $survey_json,
                    'current_section' => $current_section,
                ]);

                Log::info('evaluacion creada user => ' . $user->name);
                Log::info('EV ID => ' . $ev->uuid);
                Log::info('Encuesta => ' . $survey->name);
            }


            DB::commit();
        }
        catch(Exception $ex) { 
            Log::error(json_encode(["encuesta" => $survey , "user" => $user]));
            Log::error($ex);            
            DB::rollBack();
            return false;
        }        

        return true;
    }


    public function participantes() {
                
        $query = false;
        if($this->objectives->count() ) {
            $query = $this->objectives();
        }
        else if($this->evaluations->count()) {
            $query =  $this->evaluations();
        }
        else if($this->retroalimentaciones->count()) {
            $query =  $this->retroalimentaciones();
        }
        else if($this->pdi->count()){
            $query =  $this->pdi();
        }
        if($query) {
            $query = $query->select('user_id', 'employee_name', 'udn', 'level', 'job');
        }
        return $query;

    }
}