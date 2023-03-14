@extends('layouts.dashboard')
@section('title', 'Retroalimentaciones')


@section('dashboard-main-content')
    <section class="section">        
        <p class="subtitle">Retroalimentaciones <b>( {{$control->name}} )</b></p>
        <hr>

        <v-table :v_data="{{$retro}}" v_size_page="10" can_export="true" url_export="{{route('admin.export.retroalimentaciones')}}">
            <b-table-column v-slot="props" searchable sortable label="Colaborador" field="employee_name">
                @{{props.row.employee_name}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="buscar por nombre"
                    icon="magnify"
                    size="is-small" />
                </template>
            </b-table-column>
            <b-table-column v-slot="props" searchable sortable label="Puesto" field="job_name">
                @{{props.row.job_name}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="Buscar por puesto"
                    icon="magnify"
                    size="is-small" />
                </template>
            </b-table-column>

            <b-table-column v-slot="props" searchable sortable label="UDN" field="profile.udn.name">
                @{{props.row.profile.udn.name}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="Buscar por udn"
                    icon="magnify"
                    size="is-small" />
                </template>
            </b-table-column>

            <b-table-column v-slot="props" label="¿Qué le quiero reconocer?" width="400">
                <p>@{{props.row.respuesta1}}</p>                                
            </b-table-column>

            <b-table-column v-slot="props" label="¿Qué le falta desarrollar?" width="400">
                <p>@{{props.row.respuesta2}}</p>       
            </b-table-column>
        </v-table>
    </section>
@endsection