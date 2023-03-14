@extends('layouts.dashboard')
@section('title', 'Evaluación de perfil')
@section('header_style')
<style>
    .modal-card-body {
        max-height: 130px;
    }
</style>
@endsection
@section('dashboard-main-content')
    <section class="section">                
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
                <tr style="text-align:center">
                    <th>{{$ev->employe_name}}</th>
                    <th>{{$ev->job}}</th>
                    <th>{{$ev->udn}}</th>
                    <th>{{$ev->boss}}</th>
                </tr>
            </tbody>
        </table>
        <hr>
        <v-ev-perfil v_lock="{{$ev->lock}}" base_url="{{route('evaluacion-de-perfil.update', $ev->uuid)}}" :v_evaluacion="{{$ev->evaluacion}}" section="{{$section}}"></v-ev-perfil>        
</section>
@endsection
