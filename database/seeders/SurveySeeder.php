<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Survey;
use App\Models\Summary;
use App\Models\Subsummary;
use App\Models\Question;
use App\Models\Option;


class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $opts = [
            ['text' => 'Nunca (0%-29%)', 'color' => '#FF9966', 'value' => 1],
            ['text' => 'Casí Nunca (30%-59%)', 'color' => '#FFD966', 'value' => 2],
            ['text' => 'Casí Siempre (60%-89%)', 'color' => '#2F75B5', 'value' => 3],
            ['text' => 'Siempre (90%-100%)', 'color' => '#92D050', 'value' => 4],
        ];

        $opts2 = [
            ['text' => 'No lo hace', 'color' => '#FF9966', 'value' => 1],
            ['text' => 'Pocas veces lo hace', 'color' => '#FFD966', 'value' => 2],
            ['text' => 'Casi siempre lo hace', 'color' => '#2F75B5', 'value' => 3],
            ['text' => 'Siempre lo hace', 'color' => '#92D050', 'value' => 4],
        ];

        $opts3 = [
            ['text' => 'Totalmente desacuerdo', 'color' => '#FF9966', 'value' => 1],
            ['text' => 'desacuerdo', 'color' => '#FFD966', 'value' => 2],
            ['text' => 'De acuerdo', 'color' => '#2F75B5', 'value' => 3],
            ['text' => 'Totalmente de acuerdo', 'color' => '#92D050', 'value' => 4],
        ];


        $survey = Survey::create([
            'name' => 'EVALUACIÓN DE DESEMPEÑO Y POTENCIA',
            'description' => 'Evaluación de desempeño y potencia.',            
        ]);
        
        
        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'METAS']);

        foreach ($opts as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }        
        $sub = Subsummary::create(['text' => 'Alcance de Metas', 'summary_id' => $summary->id]);    

        Question::create([
            'text' => "<p><b>Tomando en cuenta los últimos 3 años</b>:<br>
            ¿Ha cumplido con sus objetivos en tiempo y forma, manteniendo los estándares de calidad requeridos?<br>
            *Si tu colaborador lleva menos tiempo, considera desde su ingreso.<br>
            *Respalda tu respuesta con los formatos de cumplimiento de objetivos que han establecido a lo largo de estos tres años.</p>",
            'subsummary_id' => $sub->id,
        ]);
        Question::create([
            'text' => "<p><b>Tomando en cuenta los últimos 12 meses: </b><br>
            ¿Cumple con sus objetivos en tiempo y forma, manteniendo los estándares de calidad requeridos?<br>
            *Respalda tu respuesta con el formato de cumplimiento de obetivos que han establecido.</p>",            
            'subsummary_id' => $sub->id,
        ]);

        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'COMPETENCIAS']);
        foreach ($opts2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }

        $sub = Subsummary::create(['text' => 'Visión Global del Negocio', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Percibe la organización como un "todo", sus decisiones consideran toda la información y las demandas del entorno.']);
        $sub = Subsummary::create(['text' => 'Pensamiento y Planeación Estratégica', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Establece y comunica el quehacer y el camino que se debe recorrer a corto-mediano y largo plazo, alineándolos a la visión del negocio para alcanzar las metas.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Establece las prioridades del área a su cargo, diferenciando lo urgente y lo importante.']);        
        $sub = Subsummary::create(['text' => 'Retroalimentación y Empowerment', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Delega y empodera; da guía, seguimiento y retroalimentación a los miembros de su equipo.']);
        $sub = Subsummary::create(['text' => 'Desarrollo de Talento', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Procura identificar los talentos clave y se asegura de que exista una estrategia para el desarrollo de esas personas.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra interés en crecer y desarrollarse profesionalmente y sigue las estrategias de desarrollo que la empresa le proporciona.']);
        $sub = Subsummary::create(['text' => 'Solución de Problemas - Desarrolla Alternativas', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Se anticipa a los posibles problemas y muestra disposición y proactividad para la solución.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Implementa soluciones oportunas y creativas, alineadas a la visión del negocio.']);
        $sub = Subsummary::create(['text' => 'Valentía y Determinación', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Actúa con firmeza en los casos que requieren tomar decisiones díficiles.']);
        $sub = Subsummary::create(['text' => 'Accountability (Responsabilidad)', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Asume la responsabilidad de sus acciones e impacto, reconociendo las fallas y afrontando las consecuencias.']);
        $sub = Subsummary::create(['text' => 'Excelencia', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Genera ideas y acciones bajo los más altos niveles de calidad y ética, que permite distinguirnos en el entorno.']);
        $sub = Subsummary::create(['text' => 'Esperanza', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Ofrece alternativas optimistas y alentadoras en momentos dífíciles, sin perder la objetividad. ']);
        $sub = Subsummary::create(['text' => 'Comunicación', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Comunica claramente sus puntos de vista y está dispuest@ a escuchar la información de otros.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Mantiene una comunicación abierta y oportuna sobre los temas relevantes del negocio. ']);
        $sub = Subsummary::create(['text' => 'Inteligencia Emocional', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Regula su propia respuesta emocional, incluso en situaciones complejas y es empátic@ ante las emociones de los demás. ']);


        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'VALORES']);
        foreach ($opts2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }

        $sub = Subsummary::create(['text' => 'Integridad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Se comporta de manera congruente, confiable, justa y honesta, demostrándolo en sus acciones y trato.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Toma decisiones y acciones orientadas hacia el bien de la organización.']);

        $sub = Subsummary::create(['text' => 'Unidad', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Integra equipos cohesivos (unidos y alineados) y fomenta la colaboración para el logro de objetivos.']);

        $sub = Subsummary::create(['text' => 'Bienestar', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Trabaja continuamente por ser la mejor versión de si mism@.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Promueve y apoya las estrategias de bienestar del Grupo, generando un ambiente sano en donde se disfruta trabajar.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Respeta y promueve el balance trabajo-vida personal.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra una actitud de disposición y servicio hacia las personas, equipo y empresa.']);



        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'TALENTO']);
        foreach ($opts2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }

        $sub = Subsummary::create(['text' => 'Innovación', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Mantiene un enfoque de apertura y sensibilidad ante las oportunidades para su área y para el negocio en general. ']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Genera ideas creativas que desafian el status quo y dan valor agregado al negocio. ']);
        
        $sub = Subsummary::create(['text' => 'Empuje', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Es persistente, encuentra el cómo sí hacer las actividades, a pesar de las dificultades.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Mantiene el entusiasmo ante tareas y retos.']);
        
        $sub = Subsummary::create(['text' => 'Adaptabilidad y Agilidad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Es flexible, responde rápido y positivamente al cambio, adaptando sus estrategias.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Tiene facilidad para aprender y desarrollar nuevas habilidades.']);

        $sub = Subsummary::create(['text' => 'Autonomía', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Actúa con autonomía, requiere poca supervisión.']);

        $sub = Subsummary::create(['text' => 'Influencia', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Es capaz de influir e inspirar positivamente a otros alineándose a la cultura del negocio.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Dirige equipos para el cumplimiento de los objetivos.']);
        
                
        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'Talento.']);
        foreach ($opts3 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }
        $sub = Subsummary::create(['text' => 'Talento', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Ofrece un alto valor y es dificil de reemplazar en la organización.']);

        $sub = Subsummary::create(['text' => 'Crecimiento', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra potencial para desempeñar un mayor rol en un periodo de 1 a 3 años.']);

    }
}
