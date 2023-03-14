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

            </tr>
            <tr>
                <th colspan="3" style="color:black; text-align:center; vertical-align:middle; font-weight: bold;">
                    Reporte de planes de desarrollo individual                
                </th>                
            </tr>
            <tr>
                @foreach (['Colaborador', 'Puesto', 'Jefe Inmediato', 'UDN', 'Enlace'] as $item)
                    <th style="color:black; text-align:center; vertical-align:middle; font-weight: bold;">
                        {{$item}}
                    </th>    
                @endforeach
                
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->puesto}}</td>
                    <td>{{$item->jefe_inmediato}}</td>
                    <td>{{$item->udn}}</td>
                    <td>
                        <a href="{{config('app.url') . '/admin/dashboard/pdi/' . $item->id . '/show'}}" target="_blank">
                            Ver
                        </a>
                    </td>                                
                </tr>                
            @endforeach         
        </tbody>
    </table>    
</body>
</html>