<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobCompetence;
use App\Models\Knowledge;

class TMECPuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job = Job::firstOrCreate(['name' => 'Director Corporativo de Construcción']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de Recursos', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Director Corporativo de Construcción']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Financieros', 'notas' => "Financieros\n- Entendimiento de Estados Financieros\n- Inversiones\n- Presupuestos"]);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión del Riesgo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas y Sistemas de Gestión de Calidad', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Sentido de Urgencia', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Desarrollo de Infraestructura', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Edificación de Obras Civiles', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativa SCT', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de Proyectos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marco Legal Laboral (bases)', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Obra']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Obra']);
        $job = Job::firstOrCreate(['name' => 'Coordinador Administrativo']);
        $job = Job::firstOrCreate(['name' => 'Coordinador Administrativo']);
        $job = Job::firstOrCreate(['name' => 'Auditor']);
        $job = Job::firstOrCreate(['name' => 'Auditor']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Administración de Obra']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Planificación y Organización', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Administración de Obra']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Softwares de diseño (versión visor)', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación a los Resultados', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Neodata', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de Riesgos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de presupuestos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Atención al Detalle ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas relacionadas a la construcción y la Secretaría de Comunicaciones y Transporte (SCT)', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Dominio Normativo', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Ejecutividad', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Auxiliar Administrativo']);
        $job = Job::firstOrCreate(['name' => 'Auxiliar Administrativo']);
        $job = Job::firstOrCreate(['name' => 'Coordinador Técnico']);
        $job = Job::firstOrCreate(['name' => 'Coordinador Técnico']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Ingeniería']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Ingeniería']);
        $job = Job::firstOrCreate(['name' => 'Asistente Tecnico de Proyectos']);
        $job = Job::firstOrCreate(['name' => 'Asistente Tecnico de Proyectos']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Obra']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Obra']);
        $job = Job::firstOrCreate(['name' => 'Ingeniero Residente Especialista en Precios Unitarios']);
        $job = Job::firstOrCreate(['name' => 'Ingeniero Residente Especialista en Precios Unitarios']);
        $job = Job::firstOrCreate(['name' => 'Ingeniero Residente de Planeación de Obra']);
        $job = Job::firstOrCreate(['name' => 'Ingeniero Residente de Planeación de Obra']);
        $job = Job::firstOrCreate(['name' => 'Auxiliar Topógrafo']);
        $job = Job::firstOrCreate(['name' => 'Auxiliar Topógrafo']);            
    }
}
