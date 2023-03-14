<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    use HasFactory;
    protected $table  = 'knowledges';
    public $timestamps = false;
    protected $fillable = ['name', 'job_id'];

}
