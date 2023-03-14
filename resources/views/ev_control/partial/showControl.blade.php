<section class="section">
    <h3 class="title is-4">
        {{$evControl->name}}
    </h3>
    
    <p class="subtitle is-5">
        {{$evControl->description}}
    </p>
    <hr>    
    <form method="post" action="{{route('admin.evaluaciones.update', $evControl)}}">
        @csrf
        @method('put')
        <table class="table is-striped is-bordered is-fullwidth table-evaluation">
            <thead>
                <tr>
                    <th>Sección</th>
                    <th>Bloquear</th>
                </tr>
            </thead>
            <tbody>
                @if($evControl->objectives->count())
                    <tr>
                        <td>Objetivos</td>
                        <td>
                            <input type="checkbox" value="1" name="lock_objectives" @if($evControl->lock_objectives) checked @endif id="">
                        </td>
                    </tr>                    
                @endif
                @if($evControl->evaluations->count())
                <tr>
                    <td>
                        Evaluación de desempeño y potencial
                    </td>
                    <td><input type="checkbox" value="1" name="lock_ev_dp" @if($evControl->lock_ev_dp) checked @endif id=""></td>
                </tr>
                @endif
                @if($evControl->retroalimentaciones->count())
                <tr>
                    <td>
                        Retroalimentación
                    </td>
                    <td>
                        <input type="checkbox" value="1" name="lock_retro" @if($evControl->lock_retro) checked @endif id="">
                    </td>
                </tr>
                @endif
                @if($evControl->pdi->count())
                <tr>
                    <td>
                        Plan de desarrollo individual
                    </td>
                    <td>
                        <input type="checkbox" value="1" name="lock_pdi" @if($evControl->lock_pdi) checked @endif id="">
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        <div class="field">
            <button class="button is-primary" type="submit">
                <span class="icon">
                    <i class="fas fa-save"></i>
                </span>
                <span>Guardar</span>
            </button>
        </div>        
    </form>
    <hr>

        <p class="subtitle is-4">
            Participantes
        </p>
        <div class="columns">
            <div class="column">
                <form action="" method="GET" style="margin-bottom: 1em;">
                    <b-field>
                        <b-input placeholder="Bucar en participantes ..."
                            type="Buscar"
                            icon="magnify">
                        </b-input>
                        <p class="control">
                            <b-button type="is-primary" label="Search" native-type="submit" />
                        </p>
                    </b-field>
                </form>
            </div>
            <div class="column">
                <form action="{{route('admin.evControl.addUser', $evControl->id)}}" method="POST">
                    @csrf
                    <b-field>
                        <v-generic-autocomplete placeholder="agregar usuarios" :options="{{$users}}" :clear="false"> 

                        </v-generic-autocomplete>
                        <p class="control">
                            <b-button type="is-primary" label="Agregar usuario" native-type="submit">

                            </b-button>
                        </p>
                    </b-field>
                </form>                
            </div>
        </div>
        



        
        <v-table :v_data="{{$participantes}}">
            <b-table-column v-slot="props" label="Nombre">
                @{{props.row.employee_name}}
            </b-table-column>

            <b-table-column v-slot="props" label="Puesto">
                @{{props.row.job}}
            </b-table-column>

            <b-table-column v-slot="props" label="Nivel">
                @{{props.row.level}}
            </b-table-column>

            <b-table-column v-slot="props" label="UDN">
                @{{props.row.udn}}
            </b-table-column>
        </v-table>
        <hr>
</section>    