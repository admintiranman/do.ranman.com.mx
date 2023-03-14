<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use App\Models\Survey;
use App\Models\Summary;
use App\Models\Subsummary;
use App\Models\Question;
use App\Models\Option;

class gerente_survey_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $survey = Survey::create([
            'name' => 'EVALUACIÓN DE DESEMPEÑO Y POTENCIA (Gerentes)',
            'description' => 'Evaluación de desempeño y potencia.',
            'level_id' => Level::where("name", "Gerencia")->first()->id

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
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Crea equipos inclusivos, con diversidad de talento e ideas para enriquecer las decisiones y acciones']);
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
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Guía al equipo a cumplir en la expectativa de lo que queremos alcanzar en un futuro']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Percibe el negocio como un "todo", sus decisiones integran todas las variables internas y externas, ve el panorama completo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Prevee los riesgos y/o oportunidades que puedan tener impacto sobre el área, y propone posibles soluciones']);

        $sub = Subsummary::create(['text' => 'Enfoque Estratégico', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Propone estrategias, nuevos modelos y formulas para lograr los objetivos del negocio']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Propone un plan para lograr los objetivos y determina las prioridades del área']);
        $sub = Subsummary::create(['text' => 'Orientación a Resultados', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Establece los objetivos de su área, siendo realistas, claros y retadores, alineados a la cultura y visión de negocio']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Toma decisiones gerenciales asertivas y oportunas, incluso en situaciones complejas y bajo presión']);
        $sub = Subsummary::create(['text' => 'Negociación', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Implementa tácticas de negociación que se ajustan al perfil de los "actores" que intervienen, logrando acuerdos satisfactorios']);
        
        $sub = Subsummary::create(['text' => 'Adaptación y Aprendizaje', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Es flexible y responde rápido al cambio, adaptando la planificación de actividades para sacar el mayor provecho de ello']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Ofrece alternativas alentadoras en momentos difíciles, sin perder la objetividad']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Se mantiene actualizad@, propone y ejecuta nuevas ideas y/o tendencias para mejorar el área y/o negocio.']);



        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'TALENTO Y EQUIPOS']);
        foreach (OPTIONS_2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }
        $sub = Subsummary::create(['text' => 'Excelencia', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Es una persona que día con día se prepara y busca ser el/la mejor en lo que hace']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Trabaja y entrega resultados bajo altos niveles de calidad, cuidando los detalles']);
        $sub = Subsummary::create(['text' => 'Inteligencia Emocional', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Regula su propia respuesta emocional, incluso en situaciones complejas']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'En momentos de crisis y presiones, muestra templanza y empatía']);
        $sub = Subsummary::create(['text' => 'Comunicación', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Comunica y/o presenta sus ideas, proyectos, etc. con seguridad y claridad, influyendo positivamente y dispuest@ a escuchar la información de otros']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Expone con respeto sus ideas y puntos de vista, incluso cuando opina diferente que el resto']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Informa a su jefe y a los miembros de su equipo/entorno, acerca de los temas relevantes de manera oportuna']);
        $sub = Subsummary::create(['text' => 'Construcción de Relaciones', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Construye y mantiene buenas relaciones (pares, colaboradores, clientes, etc.) formando redes de trabajo encaminadas a alcanzar metas comunes']);

        $sub = Subsummary::create(['text' => 'Desarrollo de Talento y Equipo', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Implementa un plan de desarrollo para mejorar el desempeño y potencial de cada miembro de su equipo a cargo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Delega y da guía a los miembros de su equipo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Brinda, recibe y solicita retroalimentación, y ejecuta las recomendaciones derivadas de ella']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Brinda reconocimiento del valor que aporta cada miembro del equipo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Se asegura que existan posibles sucesores para los puestos críticos de su área y se enfoca en desarrollarlos']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra interés en desarrollarse y sigue las estrategias de desarrollo que la empresa le proporciona']);
        // Potencial
        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'POTENCIAL']);
        foreach (OPTIONS_2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }
        $sub = Subsummary::create(['text' => '<b>Creétela</b> (Empuje, Determinación y Perseverancia)', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Busca incursionarse en nuevos retos, saliendo de su zona de confort para generar mayor valor']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra y contagia energía y entusiasmo por lograr los objetivos del Grupo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Es persistente, encuentra el cómo sí lograr los objetivos, a pesar de las dificultades']);
        $sub = Subsummary::create(['text' => 'Autonomía', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Trabaja sin necesidad de supervisión, cumple con sus actividades, actuando con proactividad']);
        $sub = Subsummary::create(['text' => 'Agilidad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Aprende y desarrolla nuevas habilidades con facilidad']);
        $sub = Subsummary::create(['text' => 'Sentido de Oportunidad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Está al tanto de lo que pasa en el entorno con miras a detectar oportunidades para el área y/o para el negocio en general.']);
        $sub = Subsummary::create(['text' => 'Creatividad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Genera ideas creativas y/o novedosas, que dan valor agregado al área']);
        
    }
}
