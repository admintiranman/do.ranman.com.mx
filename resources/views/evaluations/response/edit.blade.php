@extends('layouts.dashboard')
@section('title', $evaluation->name_survey)

@section('dashboard-main-content')
    <section class="section">        
        <table class="table is-fullwidth table-evaluation">
            <thead>
                <tr>
                    <th colspan="3">Evaluación de desempeño y potencial</th>
                </tr>
            </thead>
        </table>
        <table class="table is-fullwidth table-evaluation is-bordered">
            <thead>
                <tr>
                    <th>Nombre del colaborador</th>
                    <th>Puesto</th>
                    <th>UDN</th>
                    <th>Jefe directo</th>
                </tr>                
            </thead>
            <tbody>
                <tr>
                    <th style="text-align:center">{{$evaluation->employee_name}}</th>
                    <th style="text-align:center">{{$evaluation->job}}</th>
                    <th style="text-align:center">{{$evaluation->udn}}</th>
                    <th style="text-align:center">{{$evaluation->boss}}</th>
                </tr>
            </tbody>
        </table>
        <hr>
        <v-survey-response v_lock="{{$evaluation->lock}}" base_url="{{route('evaluacion.edit', $evaluation->uuid)}}" section="{{$section}}" :survey="{{$evaluation->survey}}"></v-survey-response>
</section>
@endsection
