@extends('layouts.dashboard')
@section('title', $pdi->nombre)

@section('dashboard-main-content')
    <section class="section">
        <table class="table is-fullwidth table-evaluation is-bordered">
            <thead>
                <tr>
                    <th>Nombre del colaborador</th>
                    <th>Puesto</th>
                    <th>Jefe Inmediato</th>
                    <th>UDN</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align:center">
                    <th>{{ $pdi->nombre }}</th>
                    <th>{{ $pdi->puesto }}</th>
                    <th>{{ $pdi->jefe_inmediato }}</th>
                    <th>{{ $pdi->udn }}</th>
                </tr>
            </tbody>
        </table>

        @php
            $user_id = Auth::user()->id;
            $pdi_boss = $pdi->user->boss->id;
            $pdi_profile_id = $pdi->user_id;

        @endphp
        <v-pdi 
            profile_id="{{$user_id}}" 
            pdi_boss_id="{{$pdi_boss}} "
            pdi_profile_id="{{$pdi_profile_id}}"
            :show_sign_button="false"
            :lock="true" 
            pcomentarios="{{$pdi->comentarios}}" 
            :body="{{$pdi->body}}" 
            url_update=""
        >
        </v-pdi>
    </section>
@endsection
