@extends('layouts.dashboard')
@section('title', 'Adminsitración de puestos')


@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4 is-spaced">
            Adminsitración de puestos
        </p>
        <hr>
        <v-table :v_data="{{$jobs}}" v_size_page="10">
            <b-table-column v-slot="props" searchable label="Nombre del puesto" field="name">
                @{{props.row.name}}
                <template #searchable="props">
                    <b-input
                    v-model="props.filters[props.column.field]"
                    placeholder="buscar ..."
                    icon="magnify"
                    size="is-small" />
                </template>
            </b-table-column>
            <b-table-column label="Opciones" v-slot="props">
                <a :href="'/admin/jobs/' + props.row.id+ '/edit' "  >
                    Editar
                </a>
            </b-table-column>            
        </v-table>
    </section>
@endsection