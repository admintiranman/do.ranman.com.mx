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
        $yPotencial = 0;        
        $yTotal = 0;
        
        $is_potencial = false;
        
        // METAS
        $metas = 0;
        $xMetasTotal = 0;
        
        // Valores
        $valores = 0;
        $xValoresTotales = 0; 

        // negocio
        $negocio = 0; 
        $xNegocioTotal = 0; 

        // talento y equipo
        $talento = 0;
        $xTalentoTotal = 0;

        
        
        
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
                    switch(strtoupper(trim($t->text))) {
                        case "METAS":
                            $xMetasTotal = (max($aux) * count($s->questions)) + $xMetasTotal;
                            $metas = $acum; 
                        break;
                        case "VALORES":
                            $xValoresTotales = (max($aux) * count($s->questions)) + $xValoresTotales;
                            $valores = $acum; 
                        break;

                        case "NEGOCIO":
                            $xNegocioTotal = (max($aux) * count($s->questions)) + $xNegocioTotal;
                            $negocio = $acum; 
                        break;

                        case "TALENTO Y EQUIPOS":
                            $xTalentoTotal = (max($aux) * count($s->questions)) + $xTalentoTotal;
                            $talento = $acum; 
                        break;
                    }
                }
            }
        }
        $this->x_rendimiento  = 
            round(
                (($metas / $xMetasTotal ) * 60) +
                (($valores / $xValoresTotales ) * 10) +
                (($negocio / $xNegocioTotal ) * 15) +
                (($talento / $xTalentoTotal ) * 15)            
            )
            ;
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
