<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoreCompetence extends Model
{
    use HasFactory;
    protected $table = 'core_competencies';
    protected $fillable = ['name', 'job_id'];

    public $timestamps = false;
    protected $hidden = ['pivot'];
}
