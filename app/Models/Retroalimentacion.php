<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retroalimentacion extends Model
{
    use HasFactory;

    protected $table = 'retroalimentaciones';
    protected $fillable = ['ev_control_id','user_id','employee_name', 'job', 'boss', 'udn' ,'level', 'respuesta1', 'respuesta2', 'lock', 'avance'];
    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'lock' => 'boolean'
    ];


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



    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function  control() {
        return $this->belongsTo(EvControl::class, 'ev_control_id', 'id');
    }

}