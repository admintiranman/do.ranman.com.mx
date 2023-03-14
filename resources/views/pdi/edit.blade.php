@extends('layouts.dashboard')
@section('title', 'Plan De Desarrollo Individual')

@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4 is-spaced">Plan de Desarrollo Individual</p>
        <hr>
        <table class="table is-fullwidth table-evaluation is-bordered">
            <thead>
                <tr>
                    <th>Nombre del colaborador</th>
                    <th>Puesto</th>
                    <th>Jefe inmediato</th>
                    <th>UDN</th>
                    
                </tr>                
            </thead>
            <tbody>
                <tr style="text-align:center">
                    <td>{{$pdi->employee_name}}</td>
                    <td>{{$pdi->job}}</td>
                    <td>{{$pdi->boss}}</td>
                    <td>{{$pdi->udn}}</td>
                </tr>
            </tbody>
        </table>
        @php
            $current_user_id = Auth::user()->id;
            $boss_id = $pdi->user->boss->id;
            $user_id = $pdi->user->id;
        @endphp
        <v-pdi 
            profile_id="{{$current_user_id}}" 
            pdi_boss_id="{{$boss_id}} "
            pdi_profile_id="{{$user_id}}"
            show_sign_button="{{($pdi->sign_boss == null && $current_user_id == $boss_id)  || ($pdi->sign_employee == null && $current_user_id == $user_id)}}"
            lock="{{$pdi->lock || ($pdi->sign_boss != null) }}" 
            pcomentarios="{{$pdi->comentarios}}" 
            :body="{{$pdi->body}}" 
            url_update="{{route('pdi.update', $pdi->id)}}"
        >
        </v-pdi>                
    </section>
@endsection