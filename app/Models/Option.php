<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Option extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['summary_id', 'text',  'color', 'value'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
