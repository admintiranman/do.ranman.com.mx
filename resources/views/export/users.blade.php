<table>
    <thead>
        <tr>
            <th style="font-weight: bold; font-size: 12px">Report ID</th>
            <th style="font-weight: bold; font-size: 12px">Nombre</th>
            <th style="font-weight: bold; font-size: 12px">Email</th>
            <th style="font-weight: bold; font-size: 12px">Num Nomina</th>
            <th style="font-weight: bold; font-size: 12px">Puesto</th>
            <th style="font-weight: bold; font-size: 12px">Nivel</th>
            <th style="font-weight: bold; font-size: 12px">Udn</th>
            <th style="font-weight: bold; font-size: 12px">Report To</th>
            <th style="font-weight: bold; font-size: 12px">Jefe Directo</th>
            <th style="font-weight: bold; font-size: 12px">Departamento</th>
            <th style="font-weight: bold; font-size: 12px">Puesto Critico</th>
            <th style="font-weight: bold; font-size: 12px">Talento Clave</th>
            <th style="font-weight: bold; font-size: 12px">Estatus</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->report_id == 0 ? "" : $user->report_id  }}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->num_nomina}}</td>
                <td>{{$user->job->name}}</td>
                <td>{{$user->level->name}}</td>
                <td>{{$user->udn->name}}</td>
                <td>{{$user->report_to > 0 ? $user->report_to : "" }}</td>
                <td>{{$user->boss->name??''}}</td>
                <td>{{$user->departamento->name??''}}</td>
                <td>{{$user->puesto_critico}}</td>
                <td>{{$user->talento_clave}}</td>                
                <td>{{ ($user->report_id == 0 || ( $user->report_to??1 )<=0)  ? "Baja" : "Activo"}}</td>
            </tr>            
        @endforeach
    </tbody>
</table>