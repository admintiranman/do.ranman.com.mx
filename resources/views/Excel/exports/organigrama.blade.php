<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <table border="1">
        <thead>
            <tr>
                <th>UDN</th>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>PUESTO</th>
                <th>P.C.</th>
                <th>REPORTA A </th>
                <th>NIVEL</th>
                <th>PRUEBA CORRESPONDIENTE</th>
                <th>CORREO ELECTRONICO</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)

                <tr>
                    <td>
                        {{$d->udn->name}}
                    </td>
                    <td>
                        {{$d->report_id}}
                    </td>
                    <td>
                        {{$d->user->name}}
                    </td>
                    <td>
                        {{$d->job->name}}
                    </td>
                    <td></td>
                    <td>
                        {{$d->report_to}}
                    </td>
                    <td>
                        {{$d->level->name}}
                    </td>
                    <td>
                        {{$d->level->name}}
                    </td>
                    <td>
                        {{$d->user->email}}
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>

    </table>






    
</body>
</html>