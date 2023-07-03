<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Survey extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'level_id', 'enabled'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function level() {
        return $this->belongsTo(Level::class);
    }

    public function summaries() {
        return $this->hasMany(Summary::class);
    }

    public static function boot() {
        parent::boot();

        static::creating(function ($s) {
            $s->slug = Str::slug( $s->name ,'-');
        });
    }

    
    public function convert_to_json() {
        $data = [];


    }

    public function clone($name = null, $description = null) {
        $clone = self::create([
            'hidden' => true,
            'name' => $name??$this->name . date('YmHis'),
            'description' =>  $description??$this->description,             
        ]);
        
        foreach($this->summaries()->get() as $s) {
            $summary = Summary::create([
                'text' => $s->text, 
                'survey_id' => $clone->id            
            ]);

            foreach($s->options()->get() as $op) {
                Option::create([
                    'color' => $op->color,
                    'value' => $op->value,
                    'text' =>  $op->text,
                    'summary_id' => $summary->id
                ]);
            }
            foreach ($s->subsummaries()->get() as $sub) {                
                $subsummary = Subsummary::create([
                    'text' => $sub->text, 
                    'summary_id' => $summary->id
                ]);
                foreach($sub->questions()->get() as $q) {
                    Question::create([
                        'text' => $q->text, 
                        'subsummary_id' => $subsummary->id
                    ]);
                } 
            }
        }
        return $clone;
    }

    protected $casts = [
        "enabled" => "boolean"
    ];



}
