<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use App\Models\Survey;
use App\Models\Summary;
use App\Models\Subsummary;
use App\Models\Question;
use App\Models\Option;


class especialista_survey_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $survey = Survey::create([
            'name' => 'EVALUACIÓN DE DESEMPEÑO Y POTENCIA (Especialistas)',
            'description' => 'Evaluación de desempeño y potencia.',
            'level_id' => Level::where("name", "Especialista")->first()->id            
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
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Toma decisiones operativas orientadas hacia el bien del área']);

        $sub = Subsummary::create(['text' => 'Unidad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra apertura a la diversidad de talento e ideas']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Participa activamente en las acciones para integrar a su equipo']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Trabaja en equipo para lograr los objetivos']);

        $sub = Subsummary::create(['text' => 'Bienestar', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Trabaja por ser una mejor persona y lo refleja en su actuar']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Trata a las personas con respeto']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra una actitud de disposición y servicio hacia las personas, equipo y empresa']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Escucha y toma en cuenta las contribuciones e ideas de los demás']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Lleva un balance trabajo-vida personal']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Genera un ambiente sano en donde se disfruta trabajar']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Cuida de su propia seguridad y la de los demás en su actuar cotidiano']);
                
        $sub = Subsummary::create(['text' => 'Cuidado Permanente del Prestigio del Grupo / Asegurar que se vive la Cultura', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Con sus decisiones y acciones vive y promueve la Cultura del Grupo, manteniendo su buena imagen y prestigio']);
        

        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'NEGOCIO']);
        foreach (OPTIONS_2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }
        $sub = Subsummary::create(['text' => 'Visión', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Expone los riesgos y/o oportunidades que puedan tener impacto en sus funciones o en el área']);        
        
        
        $sub = Subsummary::create(['text' => 'Orientación a Resultados', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Administra con efectividad el tiempo, de manera que cumple con sus actividades en los plazos establecidos']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Presente posibles alternativas de solución a problemas que se presentan o podrían presentarse']);
        $sub = Subsummary::create(['text' => 'Negociación', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Llega a acuerdos satisfactorios cuando está negociando, mantiendo buenas relaciones']);

        $sub = Subsummary::create(['text' => 'Adaptación y Aprendizaje', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Responde rápido al cambio, propone cómo sacar el mayor provecho de ello']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra objetividad y una actitud alentadora en momentos difíciles']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Se mantiene actualizad@, propone nuevas ideas para mejorar el área.']);



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

        $sub = Subsummary::create(['text' => 'Comunicación', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Comunica claramente sus puntos de vista y está dispuest@ a escuchar la información de otros']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Expone con respeto sus ideas y puntos de vista, incluso cuando opina diferente que el resto']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Informa a su jefe y compañeros del equipo/entorno, acerca de los temas relevantes de manera oportuna']);
        
        $sub = Subsummary::create(['text' => 'Construcción de Relaciones', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Construye y mantiene buenas relaciones (pares, colaboradores, clientes, etc.) formando redes de trabajo encaminadas a alcanzar metas comunes']);

        $sub = Subsummary::create(['text' => 'Retroalimentación', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Recibe y solicita retroalimentación, y ejecuta las recomendaciones derivadas de ella']);
        
        $sub = Subsummary::create(['text' => 'Desarrollo', 'summary_id' => $summary->id]);        
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra interés en desarrollarse y sigue las estrategias de desarrollo que la empresa le proporciona']);
        
        // Potencial
        $summary = Summary::create(['survey_id' => $survey->id, 'text' => 'POTENCIAL']);
        foreach (OPTIONS_2 as $option) {
            $option['summary_id'] = $summary->id;
            Option::create($option);
        }
        $sub = Subsummary::create(['text' => '<b>Creétela</b> (Empuje, Determinación y Perseverancia)', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Busca incursionarse en nuevas tareas o actividades, saliendo de su zona de confort']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Muestra y contagia energía y entusiasmo por lograr los objetivos del área']);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Es persistente, encuentra el cómo sí hacer las actividades, a pesar de las dificultades']);

        $sub = Subsummary::create(['text' => 'Autonomía', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Actúa con autonomía, requiere poca supervisión']);
        $sub = Subsummary::create(['text' => 'Agilidad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Aprende y desarrolla nuevas habilidades con facilidad']);

        $sub = Subsummary::create(['text' => 'Sentido de Oportunidad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Expone las oportunidades que detecta para mejorar como área o en sus propias funciones']);
        $sub = Subsummary::create(['text' => 'Creatividad', 'summary_id' => $summary->id]);
        Question::create(['subsummary_id' => $sub->id, 'text' => 'Propone ideas para mejorar y hacer más eficientes sus procesos']);
    }
}
