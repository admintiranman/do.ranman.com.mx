@extends('layouts.dashboard')
@section('title', 'Objetivos subidos')


@section('dashboard-main-content')
    <section class="section">
        <p class="subtitle">Objetivos subidos <b>( {{$control->name}} )</b></p>
        <hr>
        <v-table :v_data="{{$objectives}}" v_size_page="10" can_export="true" url_export="{{route('admin.export.objetivos')}}">
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
            <b-table-column v-slot="props" searchable sortable label="Puesto" field="profile.job.name">
                @{{props.row.job}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="Buscar por puesto"
                    icon="magnify"
                    size="is-small" />
                </template>
            </b-table-column>
            <b-table-column v-slot="props" searchable sortable label="UDN" field="profile.udn.name">
                @{{props.row.udn}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="Buscar por unidad de negocio"
                    icon="magnify"
                    size="is-small" />
                </template>
            </b-table-column>
            <b-table-column v-slot="props" label="Iniciales">
                <a :href= " `/objetivo/${props.row.id}/inicio` " target="_blank">
                    @{{props.row.start_filename}}
                </a>
            </b-table-column>
            <b-table-column v-slot="props" label="Finales">
                <a :href= " `/objetivo/${props.row.id}/final` " target="_blank">
                    @{{props.row.end_filename}}
                </a>
            </b-table-column>

        </v-table>
    </section>
@endsection