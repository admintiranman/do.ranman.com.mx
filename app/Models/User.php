<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    protected $fillable = [
        'name',        
        'email',
        'username_ad',
        'num_nomina', 
        'job_id', 
        'level_id', 
        'udn_id', 
        'report_id', 
        'report_to',          
        'puesto_critico',
        'talento_clave', 
        'departamento_id'
    ];



    protected $casts = [
        'puesto_critico' => 'boolean', 
        'talento_clave' => 'boolean', 
        'active' => 'boolean'
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at', 'password'
    ];




    public function team() {
        return $this->hasMany(User::class, 'report_to', 'report_id');
    }


    public function boss() {
        return $this->belongsTo(User::class, 'report_to', 'report_id');
    }


    // objetivos
    public function objetivos() {
        return $this->hasMany(Objective::class);
    }


    public function planes() {
        return $this->hasMany(PlanDesarrolloIndividual::class);
    }


    public function retro() {
        return $this->hasMany(Retroalimentacion::class);
    }


    public function vteam() {
        return $this->team()->with(
            [
                "level" => function($query) {
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
                    ->select("id", "user_id", "ev_control_id", "lock")
                    ->with(['control' => function($q){
                        $q->select('id', 'name');
                    }])        
                    ->orderBy("id", "desc");
                },
                "objetivos" => function($query) {
                    $query
                    ->select(     
                        'id',   
                        'year', 
                        "user_id",
                        'ev_control_id',                            
                        'start_filename', 
                        'end_filename',                             
                        'start_lock',
                        'end_lock'
                    )
                    ->with(['control' => function($q){
                        $q->select('id', 'name');
                    }])
                    ->orderBy("id", "desc");
                },
                "evaluaciones" => function($query) { 
                    $query
                    ->select("id", "uuid", "name_survey", "user_id", "lock", "ev_control_id")
                    ->with(['control' => function($q){
                        $q->select('id', 'name');
                    }])
                    ->orderBy("id", "desc");
                },
                
                "planes" => function($query) {
                    $query
                    ->select("id", "user_id", "ev_control_id", "lock")
                    ->with(['control' => function($q){
                        $q->select('id', 'name');
                    }]);
                }

            ]
        );
    }


    // catalogos
    // job
    public function job() {
        return $this->belongsTo(Job::class);
    }

    // evaluaciones
    public function evaluaciones() {
        return $this->hasMany(Evaluation::class);
    }

    // udn
    public function udn() {
        return $this->belongsTo(Udn::class);
    }
    
    public function hasevaluacionesPending() {
        $ids = $this->team()->pluck('id')->all();
        return Evaluation::where('status', '<>', 'close')->where('user_id', $ids)->exists();
    }

    public function level() {
        return $this->belongsTo(Level::class);
    }

    public function departamento() {
        return $this->belongsTo(Departamento::class, "departemento_id", "id");   
    }

    // determina si un usuaripo tiene jerarquia directamente sobre otro usuario
    public function hierarchy($user) : bool {
        $response = false;        
        while(!$response && $user && $user->report_to ) { 
            $response = $user->report_to == $this->report_id;
            $user = $user->boss;
        }
        return $response;
    }
}