<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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