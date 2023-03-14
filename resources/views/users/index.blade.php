@extends('layouts.dashboard')
@section('title', "Administración de usuarios")
@section('dashboard-main-content')
    <section class="section">
        <h3 class="title is-4">
            Administración de usuarios
        </h3>
        
        <hr>    
        <form action="" method="GET" style="margin-bottom: 1em;">
            <b-field>
                <b-input placeholder="Bucar por nombre ..."
                    type="Buscar"
                    icon="magnify"
                    name="search"
                    value="{{$search}}"    
                >
                </b-input>
                <p class="control">
                    <b-button type="is-primary" label="Search" native-type="submit" />
                </p>
            </b-field>
        </form>
        <v-table :v_data="{{$users}}">
            <b-table-column v-slot="props" label="Report ID">
                @{{props.row.report_id}}
            </b-table-column>

            <b-table-column v-slot="props" label="# nomina">
                @{{props.row.num_nomina}}
            </b-table-column>
            
            <b-table-column v-slot="props" label="Nombre">
                @{{props.row.name}}
            </b-table-column>

            <b-table-column v-slot="props" label="Puesto">
                @{{props.row.job.name}}
            </b-table-column>

            <b-table-column v-slot="props" label="Nivel">
                @{{props.row.level.name}}
            </b-table-column>

            <b-table-column v-slot="props" label="UDN">
                @{{props.row.udn.name}}
            </b-table-column>

            <b-table-column v-slot="props" label="Jefe directo">
                @{{props.row.boss? props.row.boss.name : ''}}
            </b-table-column>
        </v-table>
    </section>    
@endsection