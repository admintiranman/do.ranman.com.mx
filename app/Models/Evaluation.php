<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'ev_control_id',
        'uuid',
        'name_survey',
        'description_survey',
        'level',
        'user_id',
        'employee_name',
        'job_name',
        'evaluated_by',
        'udn',
        'status',
        'comments',
        'x_rendimiento',        
        'y_potencial',        
        'survey',
        'current_section', 
        'lock'
    ];



    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();

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


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'survey' => 'json', 
        'lock' => 'boolean',
    ];



    public function  control() {
        return $this->belongsTo(EvControl::class, 'ev_control_id', 'id');
    }


    public function resultados() {
        $xDesempenio = 0;
        $yPotencial = 0;
        $xTotal = 0;
        $yTotal = 0;
        $is_potencial = false;
        $metas = 0;
        $object = json_decode($this->survey);
        foreach($object as $t) {
            
            $is_potencial = $t->text == "POTENCIAL";            
            $aux = [];
            foreach($t->options as $opt) {
                $aux[] = $opt->value;
            }
            foreach($t->subsummaries as $s) {
                $acum = 0; 
                foreach($s->questions as $q) {
                    $acum += $q->value??0;
                }
                if($is_potencial) { 
                    $yPotencial += $acum;
                    $yTotal = $yTotal + (max($aux) * count($s->questions));
                }
                else {

                    if($t->text == "METAS") { 
                        $metas = $acum; 
                    }
                    else { 
                        $xDesempenio += $acum;
                        $xTotal = $xTotal + (max($aux) * count($s->questions));
                    }
                }
            }
        }
        $this->x_rendimiento  = round(($xDesempenio / $xTotal) * 50) + round(($metas / 8) * 50);
        $this->y_potencial = round(($yPotencial / $yTotal) * 100);        
        
        // DB::select(
        //     DB::raw("exec desarrolloOrganizacional.dbo.sp_add_evaluacion :anio, :nombre, :udn, :nivel, :puesto, :pc, :tc, :desempenio, :Potencial, :x, :y"), 
        //     [
        //         ":anio" => $this->control->name,
        //         ":nombre" => $this-employee_name,
        //         ":udn" => $this->udn,
        //         ":nivel" => $this->level,             
        //         // ":area" => null,
        //         ":puesto" => $this->job, 
        //         ":pc" => $this->user->puesto_critico, 
        //         ":tc" => $this->user->talento_clave, 
        //         ":desempenio" =>  ($this->x_rendimiento < 56) ? 1 : ($this->x_rendimiento < 76 ? 2 : 3), 
        //         ":Potencial" => $this->y_potencial < 76 ? 1 : ($this->y_potencial < 96 ?  2   : 3) ,
        //         ":x" => $this->x_rendimiento, 
        //         ":y" => $this->y_potencial,     
        //     ]
        // );
    }

}
