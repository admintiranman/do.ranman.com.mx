<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['text', 'subsummary_id'];
    protected $hidden = ['created_at', 'updated_at' , 'deleted_at'];
    
    public function subsummary(){
        return $this->belongsTo(Subsummary::class);
    }
}
