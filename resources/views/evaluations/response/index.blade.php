@extends('layouts.dashboard')
@section('title', 'Evaluación del equipo')

@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4">Evaluaciones de tu equipo de trabajo</p>
        <hr>
        <table class="table is-striped is-bordered is-fullwidth"/>
            <thead>
                <tr>
                    <th>
                        Colaborador
                    </th>
                    <th>
                        Evaluacion
                    </th>
                    <th>
                        Estatus
                    </th>
                    <th></th>
                </tr>
            </thead>
            @forelse ($evaluations as $e)
                <tr>
                    <td>
                        {{$e->employe_name}}
                    </td>
                    <td>
                        {{$e->name}}
                    </td>
                    
                    <td>{{$e->status}}</td>
                    <td>
                        <a href="{{route('evaluacion.edit', $e)}}" class="button is-small is-warning">
                            Responder Evaluacion
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td style="text-align:center;" colspan="4">
                        Sin datos
                    </td>
                </tr>
            @endforelse

        </table>
    </section>
@endsection