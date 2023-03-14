@extends('layouts.dashboard')
@section('title', "Agregar usuario")
@section('dashboard-main-content')
    <section class="section">
        <h3 class="title is-4">
            Agregar usuario
        </h3>
        <hr>    

        <form action="{{route('user.store')}}" method="POST">
            @csrf        

            <div class="columns">
                <div class="column">
                    <b-field label="Nombre">
                        <b-input name="name"></b-input>
                    </b-field>
                </div>
                
                <div class="column">
                    <b-field label="Correo electronico">
                        <b-input name="email" type="email"></b-input>
                    </b-field>
                </div>
                
                <div class="column">
                    <b-field label="# Nomina">
                        <b-input name="num_nomina"></b-input>
                    </b-field>
                </div>
                
            </div>

            <div class="columns">
                <div class="column">
                    <b-field label="UDN">
                        <v-generic-autocomplete inputname="udn" placeholder="Unidad de negocios" :options="{{json_encode($udns)}}" :clear="false">
                        </v-generic-autocomplete>
                    </b-field>
                </div>
                <div class="column">
                    <b-field label="Nivel">
                        <v-generic-autocomplete inputname="level" placeholder="Nivel" :clear="false" :options="{{json_encode($levels)}}">

                        </v-generic-autocomplete>
                    </b-field>
                </div>
                <div class="column">
                    <b-field label="Departamento">
                        <v-generic-autocomplete inputname="departamento" placeholder="Departamento" :clear="false" :options="{{json_encode($departamentos)}}">
                        </v-generic-autocomplete>
                    </b-field>
                </div>

            </div>
        
            <div class="columns">
                <div class="column">
                    <b-field label="Jefe directo">
                        <v-generic-autocomplete inputname="jefe_directo" placeholder="Jefe directo" :options="{{json_encode($participantes)}}" :clear="false"></v-user>        
                    </b-field>
                </div>

                <div class="column">
                    <b-field label="Puesto">
                        <b-input name="job"></b-input>
                    </b-field>
                </div>

                <div class="column">
                    <b-field label="Puesto critico">
                        <b-checkbox name="puesto_critico"></b-checkbox>
                    </b-field>
                </div>
                <div class="column">
                    <b-field label="Talento Clave">
                        <b-checkbox name="talento_clave">Talento Clave</b-checkbox>

                    </b-field>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <b-field>
                        <b-button type="is-primary" native-type="submit">
                            Guardar
                        </b-button>
                    </b-field>

                </div>
            </div>
        </form>
        

    </section>    
@endsection