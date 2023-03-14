@extends('layouts.dashboard')
@section('title', $ev->employee_name)

@section('dashboard-main-content')
    <section class="section">                
        <table class="table is-fullwidth table-evaluation is-bordered">
            <thead>
                <tr>
                    <th>Nombre del colaborador</th>
                    <th>Puesto</th>
                    <th>UDN</th>
                    
                </tr>                
            </thead>
            <tbody>
                <tr style="text-align:center">
                    <th>{{$ev->employee_name}}</th>
                    <th>{{$ev->job}}</th>
                    <th>{{$ev->udn}}</th>
                    
                </tr>
            </tbody>
            <thead>
                <tr style="text-align:center">
                    <th>Evaluado por</th>
                    <th>Desempeño</th>
                    <th>Potencial</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align:center">
                    <th>{{$ev->boss}}</th>
                    <th>{{ ($ev->x_rendimiento <= 65) ? 'Bajo' : ($ev->x_rendimiento > 95 ? 'Sobrepas' : 'Esperado') }}</th>
                    <th>{{($ev->y_potencial <= 75) ? 'Bajo' :  ($ev->y_potencial > 95 ? 'Alto' : 'Medio')}}</th>
                </tr>
            </tbody>

        </table>
        

        @php
            $survey = json_decode($ev->survey);
        @endphp        

        @foreach ($survey as $summary)
            <table class="table is-fullwidth is-bordered table-evaluation">
                <thead>
                    <tr class="tr_table">
                        <th width="400" colspan="2">
                            {{$summary->text}}
                        </th>
                        <th width="450">
                            Pregunta
                        </th>
                        @foreach ($summary->options as $option)
                            <th>
                                {{$option->text}}
                            </th>
                        @endforeach                        
                        <th width="300"> 
                            Comentarios
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($summary->subsummaries as $s)
                        <tr>
                            <td rowspan="{{count($s->questions) + 1}}">
                                {{$loop->index + 1}}
                            </td>
                            <td rowspan="{{count($s->questions) + 1}}">
                                {!!$s->text!!}
                            </td>
                        </tr>

                        @foreach ($s->questions as $q)
                            <tr>
                                <td style="text-align:left !important; background-color:{{$q->color??'#ffffff'}}">
                                    {!! $q->text !!}
                                </td>
                                @foreach ($summary->options as $option)
                                    <td>
                                        <input type="radio" disabled  @if($option->value == ($q->value??0)) checked @endif />
                                    </td>                                                            
                                @endforeach
                                <td>
                                    {{$q->comments??''}}
                                </td>               
                            </tr>                               
                        @endforeach
                        
                    @endforeach
                </tbody>
            </table>            
        @endforeach

        {{-- <v-survey-response v_lock="true" base_url="{{route('evaluacion.edit', $ev->uuid)}}" section="METAS" :survey="{{$ev->survey}}"></v-survey-response> --}}
</section>
@endsection
