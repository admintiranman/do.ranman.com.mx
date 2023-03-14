<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\CoreCompetence;

class competencias_culturales_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dirección
        $competencias = [
            ['name' => 'Visión', 'notas' => ''],
            ['name' => 'Enfoque Estratégico', 'notas' => ''],
            ['name' => 'Orientación a Resultados', 'notas' => ''],
            ['name' => 'Toma de Decisiones', 'notas' => ''],
            ['name' => 'Negociación', 'notas' => ''],
            ['name' => 'Adaptación y Aprendizaje', 'notas' => ''],
            ['name' => 'Excelencia', 'notas' => ''],
            ['name' => 'Inteligencia Emocional', 'notas' => ''],
            ['name' => 'Comunicación', 'notas' => ''],
            ['name' => 'Construcción de Relaciones', 'notas' => ''],
            ['name' => 'Desarrollo de Talento y Equipo', 'notas' => ''],
            ['name' => 'Creétela (Empuje, Determinación y Perseverancia)', 'notas' => ''],
            ['name' => 'Autonomía', 'notas' => ''],
            ['name' => 'Agilidad', 'notas' => ''],
            ['name' => 'Sentido de Oportunidad', 'notas' => ''],
            ['name' => 'Creatividad', 'notas' => ''],
            ['name' => 'Cuidado permanente del prestigio del Grupo', 'notas' => 'Cuidar el prestigio/imagen del grupo'],
            ['name' => 'Asegurar que se vive la Cultura del Grupo', 'notas' => ''],
        ];
        $profiles = Profile::join('levels', 'levels.id', 'profiles.level_id')->whereIn('levels.name', ['Dirección', 'Gerencia'])->select('profiles.*')->get();
        foreach ($profiles as $p) {
            foreach ($competencias as $c) {
                $c['job_id'] = $p->job->id;
                CoreCompetence::create($c);
            }
        }
        
        // Cordinadores
        unset($competencias[1]);        
        $profiles = Profile::join('levels', 'levels.id', 'profiles.level_id')->where('levels.name', 'Coordinador')->select('profiles.*')->get();
        foreach ($profiles as $p) {
            foreach ($competencias as $c) {
                $c['job_id'] = $p->job->id;
                CoreCompetence::create($c);
            }
        }
        
        // Especialistas
        unset($competencias[9]);        
        $profiles = Profile::join('levels', 'levels.id', 'profiles.level_id')->where('levels.name', 'Especialista')->select('profiles.*')->get();
        foreach ($profiles as $p) {
            foreach ($competencias as $c) {
                $c['job_id'] = $p->job->id;
                CoreCompetence::create($c);
            }
        }

        // Soporte 
        unset($competencias[3]);        
        $profiles = Profile::join('levels', 'levels.id', 'profiles.level_id')->where('levels.name', 'Soporte Administrativo')->select('profiles.*')->get();
        foreach ($profiles as $p) {
            foreach ($competencias as $c) {
                $c['job_id'] = $p->job->id;
                CoreCompetence::create($c);
            }
        }
    }
}