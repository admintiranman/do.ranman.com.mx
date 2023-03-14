@extends('layouts.dashboard')
@section('title', 'Administración de objetivos')

@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4">Administracion de Objetivos</p>
        <hr>        
        <div class="buttons">
            <a href="{{route('admin.objetivos.create')}}" class="button is-link is-small">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>
                <span>
                    Crear objetivos
                </span>
            </a>
        </div>
        <v-table t_empty="Sin objetivos registrados" :v_data="{{json_encode($objectives)}}" v_size_page="5">
            <b-table-column v-slot="props" centered label="Año" >
                @{{props.row.year}}
            </b-table-column>
            <b-table-column v-slot="props" centered label="Permitir carga de objtivos iniciales">
                <v-lock :checked="!props.row.start_lock" intervalo="incial" :year="props.row.year"></v-lock>
                {{-- <input :checked="!props.row.start_lock" type="checkbox" name="" id="start_lock"> --}}
            </b-table-column>
            <b-table-column v-slot="props" centered label="Permitir carga de objtivos finales">                
                <v-lock :checked="!props.row.end_lock" intervalo="final" :year="props.row.year"></v-lock>
            </b-table-column>
        </v-table>
    </section>
@endsection


@section('javascript')
    
@endsection