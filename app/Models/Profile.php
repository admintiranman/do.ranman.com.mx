<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    
    protected $fillable = ['level_id', 'udn_id', 'user_id', 'report_to', 'report_id'];
    public $timestamps = false;

    public function retro() {
        return $this->hasMany(Retroalimentacion::class);
    }


    public function vteam() {

        // $profile->team()->with("retro")->get()

        
        return $this->team()->with(
            [
                "level" => function($query) {
                    $query->select("name", "id");
                }, 
                "user" => function($query) { 
                    $query->select("name", "id");
                },
                "udn" => function($query) {
                    $query->select("name", "id");
                }, 
                "job" => function($query) { 
                    $query->select("name", "id");
                }, 
                "retro" => function($query) {
                    $query
                        ->select("id", "profile_id", "ev_control_id", "lock")
                        ->with(['control' => function($q){
                            $q->select('id', 'name');
                        }])        
                        ->orderBy("id", "desc");
                },
                "objectives" => function($query) {
                    $query
                        ->select(     
                            'id',   
                            'year', 
                            "profile_id",
                            'ev_control_id',                            
                            'start_filename', 
                            'end_objectives_filename',                             
                            'start_lock',
                            'end_lock'
                        )
                        ->with(['control' => function($q){
                            $q->select('id', 'name');
                        }])
                        ->orderBy("id", "desc");
                },
                "evaluations" => function($query) { 
                    $query
                        ->select("id", "uuid", "name_survey", "profile_id", "lock", "ev_control_id")
                        ->with(['control' => function($q){
                            $q->select('id', 'name');
                        }])
                        ->orderBy("id", "desc");
                },
                
                "pdi" => function($query) {
                    $query
                        ->select("id", "perfil_id", "ev_control_id", "lock")
                        ->with(['control' => function($q){
                            $q->select('id', 'name');
                        }]);

                }

            ]
        );


        
        // return $this->team()->with("level", "user" ,"udn", "job", "retro", "pdi", "objectives", "evaluations");
        
        // return $this->hasMany(VTeam::class, 'report_to', 'report_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    // jefe directo
    public function boss() {
        return $this->belongsTo(Profile::class, 'report_to', 'report_id');
    }

    // planes de desarrollo

    public function pdi() {
        return $this->hasMany(PlanDesarrolloIndividual::class, 'perfil_id', 'id');
    }


    public function objectives() {
        return $this->hasMany(Objective::class, 'profile_id', 'id');
    }


    // Determina si un usuario tiene jerarquia directa sobre otro usuario
    public function hierarchy( $user ) : bool {
        $response = $user->profile->report_id == $this->report_to;
        $profile = $this->boss;
        while( !$response && $profile && $profile->report_to ) {
            $response = $user->profile->report_id == $profile->report_to;
            $profile = $profile->boss;            
        }
        return $response;
    }

    // Equipo de trabajo
    public function team() {
        return $this->hasMany(Profile::class, 'report_to', 'report_id');
    }

    // job
    public function job() {
        return $this->belongsTo(Job::class);
    }

    public function evaluations() {
        return $this->hasMany(Evaluation::class);
    }

    // udn
    public function udn() {
        return $this->belongsTo(Udn::class);
    }
    
    public function hasEvaluationsPending() {
        $ids = $this->team()->pluck('id')->all();
        return Evaluation::where('status', '<>', 'close')->where('profile_id', $ids)->exists();
    }

    public function level() {
        return $this->belongsTo(Level::class);
    }
}
