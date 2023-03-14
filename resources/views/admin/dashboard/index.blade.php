@extends('layouts.dashboard')
@section('title', 'Resultados de Evaluaciones')



@section('dashboard-main-content')
    @if($control)
        @php
            // Objetivos
            $total_objetivos = $control->objectives()->count();
            $objetivos_completos = $control->objectives()
                                        ->where(function ($query) { 
                                            $query->whereNotNull('start_filename')
                                                ->orWhereNotNull('end_filename');
                                        })                                
                                        ->count();
            $porcentaje_objetivos = $total_objetivos > 0 ? 100 * round($objetivos_completos / $total_objetivos, 2) : "N.A.";

            // Evaluaciones
            $total_ev = $control->evaluations()->count();
            $ev_completas = $control->evaluations()
                                ->where(function ($query) {
                                    $query->where("x_rendimiento", "<>" , 0)
                                        ->orWhere("y_potencial", "<>" , 0);
                                })
                                ->count();
            $porcentaje_ev = $total_ev > 0 ? 100 * round( $ev_completas / $total_ev , 2) : "N.A.";

            // Retroalimentaciones
            $total_retros = $control->retroalimentaciones()->count();
            $retros_completas = $control->retroalimentaciones()
                                    ->where(function ($query) { 
                                        $query->where("respuesta1", "<>" , "")
                                            ->orWhere("respuesta2", "<>" , "");
                                    })
                                ->count();
            $porcentaje_retros = $total_retros > 0?  100 * round( $retros_completas / $total_retros , 2) : "N.A.";

            // PDI
            $total_pdi = $control->pdi()->count();
            $pdi_avance = $control->pdi()->where("avance", "<>" , 0)->count();
            $porcentaje_pdi = $total_pdi > 0 ? 100 * round($pdi_avance / $total_pdi, 2) : "N.A.";

        @endphp
        <section class="section">
            
            <p class="title is-4">
                Estadisticas sobre las evaluaciones {{$control->name}}
            </p>
            

            <form action="" method="GET">
                <div class="field has-addons">
                    <div class="control">
                        <div class="select">
                        <select name="control">
                            <option value="{{$control->id}}">
                                {{$control->name}}
                            </option>
                            @foreach ($options_control as $c)
                                <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="control">
                        <button type="submit" class="button is-primary">Buscar</button>
                    </div>
                </div>            
            </form>

            <hr>
            <nav class="level">
                <div class="level-item has-text-centered">
                    <a href="{{route('admin.dashboard.objectives') . "?control=$control->id" }}">
                        <div>
                            <p class="heading">objetivos subidos</p>
                            <p class="subtitle">
                                
                                {{" $objetivos_completos de $total_objetivos ($porcentaje_objetivos%) "}}                            
                            </p>
                        </div>
                    </a>
                    
                </div>

                <div class="level-item has-text-centered">
                    <a href="{{route('admin.dashboard.evaluaciones') . "?control=$control->id" }}">
                        <div>
                            <p class="heading">evaluaciones de desempeño y potencial respondidas</p>
                            <p class="subtitle">                            
                                {{"$ev_completas de $total_ev ($porcentaje_ev%)"}}                            
                            </p>
                        </div>
                    </a>
                </div>


                <div class="level-item has-text-centered">
                    <a href="{{route('admin.dashboard.retroalimentaciones') . "?control=$control->id"}}">
                        <div>
                            <p class="heading">Retroalimentaciones realizadas</p>
                            <p class="subtitle">
                                {{" $retros_completas de $total_retros ($porcentaje_retros%) "}}                            
                            </p>
                        </div>
                    </a>
                </div>


                <div class="level-item has-text-centered">
                    <a href="{{route('admin.dashboard.pdi') . "?control=$control->id"}}">            
                        <div>
                            <p class="heading">planes de desarrollo elaborados</p>
                            <p class="subtitle">
                                {{"$pdi_avance de $total_pdi ($porcentaje_pdi%)"}}                            
                            </p>
                            
                        </div>
                    </a>
                </div>
            </nav>
        </section>

    @else
        <section class="section">
            <p class="title is-4">
                Sin Datos.
            </p>
        </section>
    @endif
@endsection