<p class="subtitle is-5 is-spaced">
    Planes de desarrollo individual&nbsp;&nbsp;&nbsp;&nbsp;
</p>

<hr>
<v-table t_empty="Sin Planes de Desarrollo." v_size_page="5" :v_data="{{json_encode($user->planes()->with('control')->whereNotNull('sign_boss')->get())}}">
    <b-table-column v-slot="props" label="Fecha" centered >
        @{{props.row.control.name}}
    </b-table-column>
    <b-table-column v-slot="props" label="Opciones" centered>
        <a :href="`/pdi/${props.row.id}/edit`">
            ver
        </a>
    </b-table-column>
</v-table>