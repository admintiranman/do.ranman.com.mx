<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanDesarrolloIndividual extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'planes_desarrollo_individual';    
    protected $fillable = [
        'ev_control_id',
        'user_id',
        'nombre', 
        'puesto', 
        'departamento', 
        'udn',
        'jefe_inmediato',
        'comentarios',
        'body', 
        'lock',
        'sign_employee', 
        'sign_employee_datetime', 
        'sign_boss', 
        'sign_boss_datetime',
        'avance'
    ]; 
    

    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'body' => 'json',
        'lock' => 'boolean',
    ];

    protected $hidden = [
        'updated_at', 
        'deleted_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }


    public function control() {
        return $this->belongsTo(EvControl::class, 'ev_control_id', 'id');
    }

    public static function boot() {

        parent::boot();


        self::creating(function ($model) {

            $user = User::find($model->user_id);
            if($user) {                
                $model->employee_name = $user->name;
                $model->job = $user->job->name;
                $model->boss = $user->boss->name??'';
                $model->udn = $user->udn->name;
                $model->level = $user->level->name??'';
                $model->departamento = $user->departamento->name??'';
            }            
        });

    }




}
