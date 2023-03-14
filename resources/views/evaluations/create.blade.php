@extends('layouts.dashboard')
@section('title', 'Crear Evaluación')
@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4 is-spaced">
            Crear nueva evaluación
        </p>
        <hr>
        <v-form-control action="{{route('admin.evaluaciones.store')}}" :users="{{json_encode($options)}}">
            @csrf
        </v-form-control>        
    </section>
@endsection