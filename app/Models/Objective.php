<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objective extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'year', 
        'ev_control_id',
        'employee_name' , 
        'user_id', 
        'start_filename', 
        'end_filename', 
        'start_path', 
        'end_path', 
        'comment', 
        'lock',
        'start_lock',
        'end_lock'
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






    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'start_lock' => 'bool',
        'end_lock' => 'bool'
    ];
    
    
    public function  control() {
        return $this->belongsTo(EvControl::class, 'ev_control_id', 'id');
    }
}
