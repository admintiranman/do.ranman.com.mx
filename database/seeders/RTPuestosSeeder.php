<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobCompetence;
use App\Models\Knowledge;


class RTPuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job = Job::firstOrCreate(['name' => 'Director de Reserva Territorial']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de Recursos', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Director de Reserva Territorial']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Financieros', 'notas' => "Financieros\n- Entendimiento de Estados Financieros\n- Inversiones\n- Presupuestos"]);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión del Riesgo', 'notas' => "Lo vives el día\nEj. Negociaciones, una mala negociación puede afectar todo el proyecto\nEj. Cumplimiento de tiempos,\nEj. Discreción"]);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Contabilidad básica', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de la Información', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Legal: agrario, civil, notarial', 'notas' => 'Cómo consultar e interpretar']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de Recursos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Expropiaciones', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación al Servicio', 'notas' => 'Con las Unidades de Negocio']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Plan de Desarrollo Urbano', 'notas' => 'Cómo consultar e interpretar']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Sensibilidad a temas sociales ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración y Evaluación de Proyectos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Sensibilidad a Necesidades Sociales ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marco Legal Laboral (bases)', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Confidencialidad ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador Administrativo']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Optimización del Tiempo ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador Administrativo']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Paquetería Office', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Análisis', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Sistema ERP', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Discreción ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Leyes Fiscales ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Colaboración con áreas estratégicas/Trabajo en Equipo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Finanzas (Presupuestos, Estados Financieros ) ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Planeación y Organización ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Cuentas por Pagar y Cuentas por Cobrar ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Búsqueda de Información', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Tesorería', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Atención al Detalle ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Auditorias ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Habilidad Numérica', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Elaboración de Cheques ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Plataforma del SAT', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Plataformas Bancarias ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Administrador de Proyectos']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Coordinación', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Administrador de Proyectos']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Planeación de Eventos ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Respuesta', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Aplicaciones Informáticas', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Confiabilidad', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Relaciones Públicas ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Construcción de Relaciones', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Derecho Agrario', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Dirección por Resultados', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Sentido Común ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Trabajo Colaborativo/ Trabajo en equipo ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Gestión Institucional']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Gestión Institucional']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Negociación']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de negociación', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Negociación']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Ley agraria ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de respuesta', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Ley de adquisiciones', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Construcción de relaciones', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Plan de desarrollo urbano', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Escucha empática', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Trabajo en equipo', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Sensibilidad a temas sociales ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Visión estratégica', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Proyectos']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Proyectos']);
        $job = Job::firstOrCreate(['name' => 'Cartografía']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Investigación y Análisis', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Cartografía']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Ley Agraria ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Control, Organización y Planeación', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Plan de desarrollo urbano, municipal y metropolitano', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Confiabilidad y Confidencialidad', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'AutoCAD', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Criterio', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'CivilCAD', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Elaboración', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'CAD Earth', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de la Información', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Manejo de Drones', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Precisión', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Valuación de Terrenos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación a la Calidad ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Disponibilidad', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Vinculación Social']);
        $job = Job::firstOrCreate(['name' => 'Vinculación Social']);
        $job = Job::firstOrCreate(['name' => 'Gerente Ambiental']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Asesorar', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente Ambiental']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normas mexicanas del sector ambiental ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Dominio Normativo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Ley  para la prevención y gestión integral de residuos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación a la Calidad', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Ley de vida silvestre', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Resolución de Problemas', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Ley del equilibrio ecológico y la protección del medio ambiente ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Retroalimentación y Control ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Ley del desarrollo forestal sustentable ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Construcción de Relaciones ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Reglamentos generales ambientales ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Sentido de Urgencia y Resolución', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de proyectos ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas ISO', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Industria Limpia ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'AutoCAD', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Arg GIS 14', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Google Earth ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Regularización']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Regularización']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Paquetería Office ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Encargado de Archivo']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Atención al detalle ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Encargado de Archivo']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Smartsheet', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Discreción ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Comprensión Lectora ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Colaboración ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Digitalización de Expedientes', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Confiabilidad ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Archivología', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Actitud de Servicio', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Organización', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Ejecutivo de Proyectos']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Negociación ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Ejecutivo de Proyectos']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Derecho Agrario', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Administración de la Confianza', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Derecho Civil ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Construcción de Relaciones ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Derecho Notarial ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Destreza Comunicativa ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Derecho Mercantil ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Empatía', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Ley de Amparo', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Autosupervisión ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Ley de Aguas Estatales ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Negociaciones', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marketing', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Analista Jurídico']);
        $job = Job::firstOrCreate(['name' => 'Analista Jurídico']);
        $job = Job::firstOrCreate(['name' => 'Director de Reserva Territorial']);
        Experience::create(['job_id' => $job->id, 'name' => 'Negociaciones exitosas con ejidatarios y particulares.', 'notas' => '']);
        Experience::create(['job_id' => $job->id, 'name' => 'Participar en una asamblea con ejidatarios y lograr el objetivo.', 'notas' => '']);

    }
}
