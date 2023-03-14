<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 


class Subsummary extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['text', 'summary_id'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function summary(){
        return $this->belongsTo(Summary::class);
    }


    public function questions(){
        return $this->hasMany(Question::class);
    }
}