@extends('layouts.dashboard')
@section('title', 'Planes de desarrollo')


@section('dashboard-main-content')
    <section class="section">
        <p class="subtitle">
            Planes de desarrollo <b>( {{$control->name}} )</b></p>
        </p>
        <hr>
        <v-table :v_data="{{$pdi}}" v_size_page="10" can_export="true" url_export="{{route('admin.export.pdi', ['control_id' => $control->id])}}">
            <b-table-column v-slot="props" searchable sortable label="Colaborador" field="nombre">
                @{{props.row.employee_name}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="buscar por nombre"
                    icon="magnify"
                    size="is-small" />
                </template>
            </b-table-column>

            <b-table-column v-slot="props" searchable sortable label="Puesto" field="puesto">
                @{{props.row.job}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="buscar por puesto"
                    icon="magnify"
                    size="is-small" />
                </template>
            </b-table-column>

            <b-table-column v-slot="props" searchable sortable label="Jefe inmediato" field="jefe_inmediato">
                @{{props.row.boss}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="buscar por supervisor"
                    icon="magnify"
                    size="is-small" />
                </template>
            </b-table-column>

            <b-table-column v-slot="props" label="UDN">
                @{{props.row.udn}}
            </b-table-column>

            <b-table-column v-slot="props" label="">
                <a target="_blank" :href="`/admin/dashboard/pdi/${props.row.id}/show`">
                    ver
                </a>
            </b-table-column>
        </v-table>
    </section>
@endsection