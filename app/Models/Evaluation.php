<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
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


    public function update_survey() {
        $evaluation = json_decode($this->survey);
        foreach ($evaluation as $item) {
            foreach ($item->subsummaries as $subsummary) {
                $i = 0;
                foreach ($subsummary->questions as $q) {
                    $question = Question::find($q->id);
                    if($question) {
                        $q->text = $question->text;
                        $i = $i+1;
                    }
                    else {
                        Log::debug("Deleted => " . $i);
                        Log::debug("Q => ". $q->text);
                        unset($subsummary->questions[$i]);
                    }
                }
                $subsummary->questions = array_values((array)$subsummary->questions);
            }
        }
        $this->survey = json_encode($evaluation);
        $this->save();
    }


    public function resultados() {

        $yPotencial = 0;
        $xRendimiento = 0;
        $object = json_decode($this->survey);
        $is_potencial = false;
        $percent = 0;
        foreach ($object as $summary) {
            switch (strtoupper($summary->text)) {
                case "RESPONSABILIDADES":
                    $percent = 60;
                    $is_potencial = false;
                break;
                case "VALORES":
                    $percent = 10;
                    $is_potencial = false;
                    break;
                case "NEGOCIO":
                    $percent = 15;
                    $is_potencial = false;
                    break;
                case "TALENTO Y EQUIPOS":
                    $percent = 15;
                    $is_potencial = false;
                    break;
                case "PUESTO CRITICO":
                    $percent = 0;
                    $is_potencial = false;
                    break;
                case "TALENTO CLAVE":
                    $percent = 0;
                    $is_potencial = false;
                break;
                case "POTENCIAL":
                    $percent = 100;
                    $is_potencial = true;
                    break;
                
            }

            $count_sections = count($summary->subsummaries);

            foreach ($summary->subsummaries as $subsummary) {


                $max_calification = count($summary->options) * count($subsummary->questions);
                $acum = 0;
                foreach ($subsummary->questions as $question) {
                    $acum += ($question->value??0);
                }
                Log::info("Calificación: ");
                Log::info("Acun: " . $acum);
                Log::info("Max_Calif: " .$max_calification);

                $value = ($acum / $max_calification) * ($percent / $count_sections);

                if($is_potencial) {
                    $yPotencial += $value;
                }
                else {
                    $xRendimiento += $value;
                }
            }
        }
        $this->x_rendimiento = round( $xRendimiento );
        $this->y_potencial = round( $yPotencial );
    }
}