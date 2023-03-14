<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
class Summary extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['text', 'survey_id'];    
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];


    public function survey(){
        return $this->belongsTo(Survey::class);
    }

    public function subsummaries(){
        return $this->hasMany(Subsummary::class);
    }


    public function options(){
        return $this->hasMany(Option::class);
    }
}
