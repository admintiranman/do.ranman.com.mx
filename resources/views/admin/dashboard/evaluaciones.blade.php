@extends('layouts.dashboard')
@section('title', 'Evaluaciones completas')


@section('dashboard-main-content')
    <section class="section">
        <p class="subtitle">Evaluaciones completas <b>( {{$control->name}} )</b></p>
        <hr>
        <v-table :v_data="{{$evaluaciones}}" v_size_page="10" can_export="true" url_export="{{route('admin.export.evaluaciones', ['control_id' => $control->id])}}">
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
                @{{props.row.job}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="buscar por puesto"
                    icon="magnify"
                    size="is-small" />
                </template>
            </b-table-column>

            <b-table-column v-slot="props" searchable sortable label="UDN" field="udn">
                @{{props.row.udn}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="buscar por UDN"
                    icon="magnify"
                    size="is-small" />
                </template>

            </b-table-column>



            <b-table-column v-slot="props" label="Desempeño/Potencial">
                @{{props.row.x_rendimiento}}/@{{props.row.y_potencial}}
            </b-table-column>

            <b-table-column v-slot="props" label="">
                <a target="_blank" :href="`/admin/ev/${props.row.uuid}/show`">
                    ver
                </a>
            </b-table-column>
        </v-table>
    </section>
@endsection