<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCompetence extends Model
{
    use HasFactory;
    protected $table = 'job_competencies';
    protected $fillable = ['name', 'job_id'];
    public $timestamps = false;
} 
