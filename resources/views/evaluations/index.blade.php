@extends('layouts.dashboard')
@section('title', 'Administración de Evaluaciones')

@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4">Administración de Evaluaciones </p>
        <hr>
        <div class="buttons">
            <a href="{{ route('admin.evaluaciones.create') }}" class="button is-small is-primary">
                <span class="icon">
                    <i class="fas fa-plus"></i>
                </span>
                <span>
                    Crear Evaluación.
                </span>
            </a>
        </div>

        <v-table :v_data="{{ $evaluations }}">            
            <b-table-column v-slot="props" label="Nombre">
                @{{props.row.name}}
            </b-table-column>            
            <b-table-column label="Detalles" v-slot="props">
                <a :href="`/admin/evaluaciones/${props.row.id}`">Ver</a>
            </b-table-column>
        </v-table>
    </section>
@endsection
