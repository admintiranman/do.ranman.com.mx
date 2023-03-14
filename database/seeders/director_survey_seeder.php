<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use App\Models\Survey;
use App\Models\Summary;
use App\Models\Subsummary;
use App\Models\Question;
use App\Models\Option;

const OPTIONS_1 = [
    ['text' => 'Nunca (0%-29%)', 'color' => '#FF9966', 'value' => 1],
    ['text' => 'Casí Nunca (30%-59%)', 'color' => '#FFD966', 'value' => 2],
    ['text' => 'Casí Siempre (60%-89%)', 'color' => '#2F75B5', 'value' => 3],
    ['text' => 'Siempre (90%-100%)', 'color' => '#92D050', 'value' => 4],
];

const OPTIONS_2 = [
    ['text' => 'No lo hace', 'color' => '#FF9966', 'value' => 1],
    ['text' => 'Pocas veces lo hace', 'color' => '#FFD966', 'value' => 2],
    ['text' => 'Casi siempre lo hace', 'color' => '#2F75B5', 'value' => 3],
    ['text' => 'Siempre lo hace', 'color' => '#92D050', 'value' => 4],
];

class director_survey_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $survey = Survey::create([
            'name' => 'EVALUACIÓN DE DESEMPEÑO Y POTENCIA (Directores)',
            'description' => 'Evaluación de desempeño y potencia.',
            'level_id' => Level::where("name", "Dirección")->first()->id
        ]);
        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'METAS']);        
        foreach (OPTIONS_1 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }
        $sub = Subsummary::create(['text' => 'Alcance de Metas', 'summary_id' => $summary->id]);
        Question::create([
            'text' => "<p>Tomando en cuenta los últimos 3 años:<br>
            ¿Ha cumplido con sus objetivos en tiempo y forma, manteniendo los estándares de calidad requeridos?<br>
            <i>*Si tu colaborador lleva menos tiempo, considera desde su ingreso.<br>
            *Respalda tu respuesta con los formatos de cumplimiento de objetivos que han establecido a lo largo de estos tres años.</i>
            </p>",
            'subsummary_id' => $sub->id,
        ]);
        Question::create([
            'text' => "<p>Tomando en cuenta los últimos 12 meses: <br>
            ¿Cumple con sus objetivos en tiempo y forma, manteniendo los estándares de calidad requeridos?<br>
            <i>*Respalda tu respuesta con el formato de cumplimiento de obetivos que han establecido</i></p>",
            'subsummary_id' => $sub->id,
        ]);

        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'VALORES']);
        foreach (OPTIONS_2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }        

        $sub = Subsummary::create(['text' => 'Integridad', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Transmite confianza, es justo y honest@ en sus acciones y trato']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Toma decisiones estratégicas orientadas hacia el bien de la organización']);

        $sub = Subsummary::create(['text' => 'Unidad', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Crea equipos inclusivos, con diversidad de talento e ideas para enriquecer las decisiones y acciones.']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Diseña y modela un amplio sentido de equipo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Define los objetivos gracias a la colaboración que existe entre los miembros del equipo']);

        $sub = Subsummary::create(['text' => 'Bienestar', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Trabaja por ser una mejor persona y busca que su equipo también lo sea']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Trata a las personas con respeto']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Modela una actitud de disposición y servicio hacia las personas, equipo y empresa']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Escucha y toma en cuenta las contribuciones e ideas de los demás para la creación de un equipo exitoso']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Lleva un balance trabajo-vida personal y lo promueve con el equipo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Contribuye a generar un ambiente sano en donde se disfruta trabajar']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Protege la seguridad de las personas y los recursos, velando por la estabilidad del Grupo']);

        $sub = Subsummary::create(['text' => 'Cuidado Permanente del Prestigio del Grupo / Asegurar que se vive la Cultura', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Con sus decisiones y acciones vive y promueve la Cultura del Grupo, manteniendo su buena imagen y prestigio']);
        
        
        

        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'NEGOCIO']);
        foreach (OPTIONS_2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }
        $sub = Subsummary::create(['text' => 'Visión', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Indica hacia dónde se dirige la empresa a largo plazo y en qué quiere convertirse en el futuro']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Percibe el negocio como un "todo", sus decisiones integran todas las variables internas y externas, ve el panorama completo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Se anticipa a los riesgos y/o oportunidades que puedan tener impacto sobre el negocio, y propone posibles soluciones']);
        $sub = Subsummary::create(['text' => 'Enfoque Estratégico', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Establece y comunica las estrategias a corto-mediano y largo plazo, para lograr los objetivos']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Determina las acciones y la asignación de recursos para alcanzar los objetivos propuestos']);
        $sub = Subsummary::create(['text' => 'Orientación a Resultados', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Establece los objetivos de la empresa que generan un alto valor, siendo realistas, claros y retadores, alineados a la cultura y visión de negocio']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Toma decisiones estratégicas asertivas y oportunas, incluso en situaciones complejas y bajo presión']);
        $sub = Subsummary::create(['text' => 'Negociación', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Implementa estrategias de negociación con notable destreza, logrando obtener beneficios como resultado de las negociaciones que realiza']);
        $sub = Subsummary::create(['text' => 'Adaptación y Aprendizaje', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra en todo momento flexibilidad  y responde rápido al cambio,  adaptando las estrategias para sacar el mayor provecho de ello']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Se sobrepone ante la adversidad y lidera con perseverancia en la incertidumbre ofreciendo alternativas alentadoras']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Se mantiene actualizad@, propone y ejecuta nuevas ideas y/o tendencias para mejorar el Negocio y/o Grupo.']);



        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'TALENTO Y EQUIPOS']);        
        foreach (OPTIONS_2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }
        $sub = Subsummary::create(['text' => 'Excelencia', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Es una persona que día con día se prepara y busca ser el/la mejor en lo que hace']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Lidera proyectos y genera resultados que nos distinguen del entorno, con altos estándares de calidad']);
        $sub = Subsummary::create(['text' => 'Inteligencia Emocional', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Regula su propia respuesta emocional, incluso en situaciones complejas']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'En momentos de crisis y presiones, muestra templanza y empatía']);
        $sub = Subsummary::create(['text' => 'Comunicación', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Comunica y/o presenta sus ideas, proyectos, etc. con seguridad y claridad, inspirando a otros, mostrándose abierto a escuchar sus opiniones']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Expone con respeto sus ideas y puntos de vista, incluso cuando opina diferente que el resto']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Mantiene una comunicación abierta y oportuna sobre los temas estratégicos del negocio']);
        $sub = Subsummary::create(['text' => 'Construcción de Relaciones', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Construye y mantiene buenas relaciones con otros (pares, colaboradores, clientes, etc.) formando redes de trabajo encaminadas a alcanzar metas comunes']);

        $sub = Subsummary::create(['text' => 'Desarrollo de Talento y Equipo', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Implementa un plan de desarrollo para mejorar el desempeño y potencial de cada miembro de su equipo a cargo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Delega y da guía a los miembros de su equipo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Brinda, recibe y solicita retroalimentación, y ejecuta las recomendaciones derivadas de ella']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Brinda reconocimiento del valor que aporta cada miembro del equipo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Se asegura que existan posibles sucesores para los puestos críticos de su UDN y se enfoca en desarrollarlos']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra interés en desarrollarse y sigue las estrategias de desarrollo que la empresa le proporciona']);
        // Potencial
        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'POTENCIAL']);
        foreach (OPTIONS_2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }
        $sub = Subsummary::create(['text' => '<b>Creétela</b> (Empuje, Determinación y Perseverancia)', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Busca incursionarse en nuevos retos, saliendo de su zona de confort para generar mayor valor']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra y contagia energía y entusiasmo por lograr la visión']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Es persistente, encuentra el cómo sí lograr los objetivos, a pesar de las dificultades']);
        $sub = Subsummary::create(['text' => 'Autonomía', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Trabaja sin necesidad de supervisión, cumple con sus actividades, actuando con proactivdad, seguridad y valentía']);
        $sub = Subsummary::create(['text' => 'Agilidad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Aprende y desarrolla nuevas habilidades con facilidad; y reta a su equipo a ser más ágil']);
        $sub = Subsummary::create(['text' => 'Sentido de Oportunidad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Busca constantemente las nuevas tendencias y las oportunidades para el negocio y el Grupo en general']);
        $sub = Subsummary::create(['text' => 'Creatividad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Lidera la disrupción, solicitando la generación de ideas y proyectos creativos']);
    }
}
