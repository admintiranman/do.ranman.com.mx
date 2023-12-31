<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;
use App\Models\Job;
use App\Models\JobCompetence;
use App\Models\Knowledge;

class WTCPuestosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job = Job::firstOrCreate(['name' => 'Director de W.T.C.']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de Recursos', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Director de W.T.C.']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Financieros', 'notas' => "Matemáticas Financieras\n- Evaluación de Proyectos Financieros\n- Entendimiento de Estados Financieros\n- Inversiones\n- Presupuestos"]);
        $job = Job::firstOrCreate(['name' => 'Director de W.T.C.']);
        Experience::create(['job_id' => $job->id, 'name' => 'Participación activa a reuniones de Consejo de Administración.', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión del Riesgo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas Contables ', 'notas' => '']);
        Experience::create(['job_id' => $job->id, 'name' => 'Participación directa en parques y proyectos industriales.', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas Fiscales ', 'notas' => '']);
        Experience::create(['job_id' => $job->id, 'name' => 'Tener formación multicultural y versatilidad para adaptarse a diferentes ambientes.', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas y Sistemas de Gestión de Calidad', 'notas' => '']);
        Experience::create(['job_id' => $job->id, 'name' => 'Negociaciones exitosas con autoridades nacionales e internacionales a diferentes niveles (federal, estatal y municipal).', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Legal (bases)', 'notas' => "Contractual\n- Entendimiento de los temas legales para identificar si puede existir algún problema, siempre apoyándose del abogado para prevenirlos y solucionarlos."]);
        Experience::create(['job_id' => $job->id, 'name' => 'Gestión de al menos un proyecto de alto impacto económico y que involucra la interacción de diferentes protagonistas. ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Negocios Internacionales', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Desarrollo de Infraestructura', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Relaciones Públicas', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Ventas y marketing ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de Proyectos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marco Legal Laboral (bases)', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Idiomas ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Desarrollo de Proyectos']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Negociación ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Desarrollo de Proyectos']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Paquetería Office', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Desarrollo de Proyectos']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Construcción de Relaciones ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Softwares de diseño', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Dirección por Resultados ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Gestión y administración de proyectos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Impacto e Influencia', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Google Earth Pro', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Innovación', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Reglamentos y ordenamientos ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Perspicacia Financiera', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Análisis de inteligencia de mercados ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Sentido de Oportunidad ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Modelos financieros para el desarrollo inmobiliario', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Visión estratégica ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Proyectos']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Evaluación', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Proyectos']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Construcción, Infraestructura, Vialidades y Edificación', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Proyectos']);
        Experience::create(['job_id' => $job->id, 'name' => 'Liderar proyectos de construcción industrial/comercial de principio a fin en diferentes locaciones', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación a la Calidad', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Elaboración, Manejo y Control de Presupuestos', 'notas' => 'Programa de Precios Unitarios']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión del Cambio', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Evaluación Financiera de Proyectos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Optimización del Tiempo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de Proyectos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación al Cliente', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marco Legal Laboral (bases)', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Toma de Decisiones Asertiva', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Inglés', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Proyectos e Infraestructura']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de Recursos', 'notas' => 'Administrar el presupuesto']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Proyectos e Infraestructura']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Evaluación Financiera de Proyectos', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Proyectos e Infraestructura']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación la Calidad', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de Proyectos', 'notas' => 'Los proyectos salgan en forma, tiempo y presupuesto.']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Respuesta', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Manejo y Control de Presupuestos', 'notas' => 'Incluye precios unitarios']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Proceso de Construcción de Infraestructura', 'notas' => 'Drenaje, Agua ,Luz']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Software de Diseño', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Inglés (intermedio)', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marco Legal Laboral (bases)', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Proyectos']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de planificación y organización', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Proyectos']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Paquetería Office ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Proyectos']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación a los resultados', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Softwares de diseño', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación a la calidad', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Gestión de proyectos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de negociación ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Software de proyectos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de riesgos ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de presupuestos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Toma de decisiones', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'ERP', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Tolerancia a la presión', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Reglamentos y normativas de construcción', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Mejoramiento continuo', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Analista Jr. de Proyectos']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de planificación y organización', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Analista Jr. de Proyectos']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Microsoft Office  ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Analista Jr. de Proyectos']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación a los resultados', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Softwares de diseño ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación a la calidad', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Gestión de proyectos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de negociación', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Softwares de proyectos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Resolución de problemas ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de presupuestos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Mejoramiento continuo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'ERP', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Reglamentos y normativas de construcción', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente Administrativo']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Visión Financiera y del Negocio', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente Administrativo']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Sistemas Administrativos Contables (ERP)', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente Administrativo']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión del Riesgo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas Contables', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de la Información', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas Fiscales', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de Recursos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Elaboración e interpretación de Estados Financieros ', 'notas' => "Estados financieros/contables básicos:\n- Estado de Resultados\n- Balance General\n- Flujo de Efectivo\n- Estado de Cambios de Capital"]);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Sentido de Urgencia', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Elaboración, Manejo y Control de Presupuestos', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Dominio y Cumplimiento Normativo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de Nóminas (IMSS, INFONAVIT, FONACOT...)', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Anticipación de Problemas', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Manejo de Bancos, Créditos Bancarios.. ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Toma de Decisiones Asertiva', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marco Legal (bases)', 'notas' => "Corporativo\nLaboral\nPara que la empresa pueda operar sin problema"]);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marco Legal Laboral (bases)', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Excel Intermedio', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Contador General']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Colaboración con áreas estratégicas/Trabajo en Equipo', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Contador General']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Sistemas Administrativos Contables (ERP)', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Contador General']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Habilidad Numérica', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Control y Gestión de Presupuestos', 'notas' => 'Supervisar que se cumpla en tiempo y forma y generar ahorros.']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Análisis', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas Fiscales', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de la Información', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas Contables', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Dominio y Cumplimiento Normativo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Elaboración e Interpretación de Informes Financieros ', 'notas' => "Estados financieros/contables básicos:\n- Estado de Resultados\n- Balance General\n- Flujo de Efectivo\n- Estado de Cambios de Capital"]);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Optimización del tiempo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Cuentas por Cobrar y Cuentas por Pagar', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Atención a Auditorias', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Tesorería', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marco Legal Laboral (bases)', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Excel Intermedio', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Contador Sr.']);
        $job = Job::firstOrCreate(['name' => 'Contador Sr.']);
        $job = Job::firstOrCreate(['name' => 'Contador Sr.']);
        $job = Job::firstOrCreate(['name' => 'Auxiliar Administrativo']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Atención al detalle', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Auxiliar Administrativo']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Atención al detalle', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Auxiliar Administrativo']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad numérica', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Capacidad numérica', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Comunicación escrita', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Comunicación escrita', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Confiabilidad', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Confiabilidad', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Planificación y organización', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Planificación y organización', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Optimización del tiempo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Optimización del tiempo', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Analista Jr. de Administración']);
        $job = Job::firstOrCreate(['name' => 'Analista Jr. de Administración']);
        $job = Job::firstOrCreate(['name' => 'Analista Jr. de Administración']);
        $job = Job::firstOrCreate(['name' => 'Tesorera']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad numérica', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Tesorera']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Manejo de ERP', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Tesorera']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de la información', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Paquetería Office', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Responsabilidad', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Instituciones bancarias (Banca)', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Perspicacia financiera', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Casa de Cambio', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Atención al detalle', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Honestidad', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente Comercial']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación al Mercado', 'notas' => 'Entender muy bien el mercado y capitalizarlo.']);
        $job = Job::firstOrCreate(['name' => 'Gerente Comercial']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Elaboración, Manejo y Control de Presupuestos', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente Comercial']);
        Experience::create(['job_id' => $job->id, 'name' => 'Haber realizado eventos y/o reuniones con extranjeros así como con gobiernos, de por lo menos 50 participantes.', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Innovación /Creatividad', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Planes Estratégicos Comerciales', 'notas' => '']);
        Experience::create(['job_id' => $job->id, 'name' => 'Haber realizado investigaciones de mercado inmobiliario industrial a nivel nacional e internacional.', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Comunicación Efectiva', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Mercadotecnia y Diseño', 'notas' => "Diseño de Imagen (alineada al negocio)\nMedios de Comunicación\nEstrategias Digitales\nTener presencia y que transmita la calidad que estamos buscando"]);
        Experience::create(['job_id' => $job->id, 'name' => 'Haber realizado negociaciones entre diferentes niveles y jerarquías dentro de la estructura de empresas transnacionales (probadas).', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Construcción de Relaciones', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Manejo de Medios de Comunicación', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación al Cliente', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Relaciones Públicas', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Toma de Decisiones Asertiva', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Eventos Empresariales', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Construcción', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Legal', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Entendimiento/Interpretación Cultural', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de Proyectos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Evaluación Financiera de Proyectos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marco Legal Laboral (bases)', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Idiomas ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Subgerente de Ventas y Marketing']);
        $job = Job::firstOrCreate(['name' => 'Subgerente de Ventas y Marketing']);
        $job = Job::firstOrCreate(['name' => 'Subgerente de Ventas y Marketing']);
        $job = Job::firstOrCreate(['name' => 'Asesor Comercial']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de negociación ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Asesor Comercial']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Paquetería Office ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Asesor Comercial']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Construcción de relaciones ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Cierres de venta ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Destreza comunicativa ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Construcción ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Liderazgo ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Operación ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación al mercado ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Legal ', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Persuasión  ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Logística de eventos ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Share Point ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Smartsheet ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Operaciones']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de Respuesta y Resolución', 'notas' => 'Disponibilidad.- Dar respuesta en tiempo y forma.']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Operaciones']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Elaboración, Manejo y Control de Presupuestos', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Gerente de Operaciones']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Mejoramiento Continuo / Orientación a la Calidad', 'notas' => "Edificios siempre en excelentes condiciones\nCumplir la expectativa del cliente"]);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas y Sistemas de Gestión de Calidad', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación al Cliente/Servicio ', 'notas' => 'Relaciones: Qué tienes que hacer y si lo haces en qué resulta, y si actúas de determinada forma con un cliente o un proveedor (teoría de restricciones)']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normativas Relacionadas a Parques Industriales (Agua, Medio Ambiente, Seguridad y Legal)', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Construcción de Relaciones', 'notas' => "Saber interactuar con diferentes niveles educativos de personas…\nConstruir/mantener relaciones con entidades de gobierno en sus tres niveles."]);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Mantenimiento a Edificios', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de Recursos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Planta de Tratamiento de Agua Residual', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Dominio y Cumplimiento Normativo', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Sistema Contra Incendios', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Toma de Decisiones Asertiva', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Construcción', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Relaciones Públicas', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Evaluación Financiera de Proyectos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Seguridad Patrimonial', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Administración de Proyectos           ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Marco Legal Laboral (bases)', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Inglés', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Auxiliar Jr. de Compras']);
        $job = Job::firstOrCreate(['name' => 'Auxiliar Jr. de Compras']);
        $job = Job::firstOrCreate(['name' => 'Auxiliar Jr. de Compras']);
        $job = Job::firstOrCreate(['name' => 'Jefe de Operaciones']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Planificación y organización', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Jefe de Operaciones']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Paquetería Office ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Jefe de Operaciones']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de recursos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'AutoCAD', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación al servicio ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normas y certificaciones relacionadas con la operación de los servicios de un parque industrial. (Ambientales, sistemas contra incendio, seguridad, etc.)', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Orientación al cliente', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Electricidad en alta y media tensión', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Resolución de problemas', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Cumplimiento de normas', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Seguridad']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Dominio normativo', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Seguridad']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Normas y certificaciones relacionadas con la operación de los servicios de un parque industrial. (Ambientales, sistemas contra incendio, seguridad, etc.) ', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Seguridad']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Ejecución ', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Paquetería Office', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Gestión de riesgos', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Sistema RFE Versión 1.0', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Pensamiento estratégico', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Sistema de Operación Integral Aduanera (SOIA)', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de asesorar', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'CCTV RFE (Equipo de cámaras del RFE)', 'notas' => '']);
        JobCompetence::create(['job_id' => $job->id, 'name' => 'Capacidad de respuesta', 'notas' => '']);
        Knowledge::create(['job_id' => $job->id, 'name' => 'Leyes y normativas del nuevo sistema penal acusatorio y del Primer Respondiente', 'notas' => '']);
        $job = Job::firstOrCreate(['name' => 'Supervisor de Sistemas de Agua']);
        $job = Job::firstOrCreate(['name' => 'Supervisor de Sistemas de Agua']);
        $job = Job::firstOrCreate(['name' => 'Supervisor de Sistemas de Agua']);
        $job = Job::firstOrCreate(['name' => 'Supervisor de Mantenimiento']);
        $job = Job::firstOrCreate(['name' => 'Supervisor de Mantenimiento']);
        $job = Job::firstOrCreate(['name' => 'Supervisor de Mantenimiento']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Atención al Cliente']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Atención al Cliente']);
        $job = Job::firstOrCreate(['name' => 'Coordinador de Atención al Cliente']);
        $job = Job::firstOrCreate(['name' => 'Supervisor de Seguridad (Recinto Fiscal)']);
        $job = Job::firstOrCreate(['name' => 'Supervisor de Seguridad (Recinto Fiscal)']);
        $job = Job::firstOrCreate(['name' => 'Supervisor de Seguridad (Recinto Fiscal)']);
        //
    }
}
