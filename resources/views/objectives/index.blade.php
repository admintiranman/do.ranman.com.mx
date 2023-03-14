@php
    $user_session = \Auth::user();
@endphp

<p class="subtitle is-5 is-spaced">
    Objetivos    
</p>
<hr>

<v-table t_empty="Sin objetivos registrados" :v_data="{{json_encode($user->objetivos()->orderBy('year', 'desc')->get())}}" v_size_page="5">
    <b-table-column v-slot="props" centered label="Año" >
        @{{props.row.year}}
    </b-table-column>
    <b-table-column v-slot="props" centered label="Objetivo Inicial">
        <a v-if="!!props.row.start_filename" target="_blank" :href="`/objetivo/${props.row.id}/inicio`">
            @{{props.row.start_filename}}
        </a>        
        <span v-else>
            Objetivos iniciales no subidos
        </span>
        <a v-if="(  props.row.user_id == {{$user_session->id}} || {{ $user_session->hierarchy($user) == true }}) && !!!props.row.start_lock" :href="`/objetivo/${props.row.id}/edit/inicio`">
            <span class="icon">
                <i class="fa fa-edit"></i>
            </span>
        </a>
    </b-table-column>
    <b-table-column v-slot="props" centered label="Objetivo Final">
        <a v-if="!!props.row.end_filename" target="_blank" :href="`/objetivo/${props.row.id}/final`">
            @{{props.row.end_filename}}            
        </a>
        <span v-else>
            Objetivos finales no subidos
        </span>
        <a v-if="( props.row.user_id == {{$user_session->id}} || {{ $user_session->hierarchy($user) == true }} ) && !!!props.row.end_lock" :href="`/objetivo/${props.row.id}/edit/final`">
            <span class="icon">
                <i class="fa fa-edit"></i>                
            </span>
        </a>
    </b-table-column>
</v-table>

