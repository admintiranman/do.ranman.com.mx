<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class EvaluacionPerfil extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'evaluacion_perfiles';

    protected $fillable = [
        'ev_control_id',
        'uuid', 'job_name', 'employee_name', 
        'level', 'profile_id', 'evaluated_by', 
        'status',  'evaluacion', 'current_section', 
        'lock'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($s) {
            $s->uuid = Str::uuid();
        });
    }

    protected $casts = [
        'evaluacion' => 'json', 
        'lock' => 'boolean',
    ];

    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
