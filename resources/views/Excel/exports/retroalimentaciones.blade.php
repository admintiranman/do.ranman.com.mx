@php
    $th = "font-weight: bold;font-size: 12px;";
    $title = "text-align: center;";
    $headers = ["Colaborador", "Puesto", "Unidad de negocio", "¿Qué le quiero reconocer?", "¿Qué le falta desarrollar?" ];
@endphp

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
            <tr></tr>
            <tr>
                <th style="{{ $title . $th . "color:black;" }}">Retroalimentaciones</th>
            </tr>
            <tr></tr>
            <tr>
                @foreach ( $headers as $h)
                        <th style="{{$th}}">{{$h}}</th>                
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $d)
                    <tr>
                        <td>{{$d->employee_name}}</td>
                        <td>{{$d->job}}</td>
                        <td>{{$d->udn}}</td>                        
                        <td>{!!$d->respuesta1!!}</td>
                        <td>{!!$d->respuesta2!!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Sin datos.</td>
                    </tr>
                @endforelse
        </tbody>
    </table>
</body>
</html>
