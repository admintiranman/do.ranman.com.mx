<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'level', 'puesto_critico', 'talento_clave'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    
    protected $casts = [
        'puesto_critico' => 'boolean',
        'talento_clave' => 'boolean',
    ];


    public function knowledge() {
        return $this->hasMany(knowledge::class);
    }

    public function experience() {
        return $this->hasMany(Experience::class);
    }


    public function core_competencies() {
        return $this->hasMany(CoreCompetence::class);
    }


    public function job_competencies() {
        return $this->hasMany(JobCompetence::class);
    }
}
