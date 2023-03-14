@php
    $th = "font-weight: bold;font-size: 12px;";
    $title = "text-align: center;";
    $headers = ["Colaborador", "Puesto", "UDN", "Objetivos Iniciales", "Objetivos Finales"];
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
                
                <th colspan="3" style="align: center; vertical-align: middle; {{$title . $th}}">Reporte de objetivos</th>
            </tr>
            <tr>                
                @foreach ($headers as $h)
                    <th style="{{$th}}">{{$h}}</th>
                @endforeach                
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
                <tr>
                    <td>{{$d->employee_name}}</td>
                    <td>{{$d->job}}</td>
                    <td>{{$d->udn}}</td>
                    <td>
                        @if ($d->start_filename)
                            <a href="{{ config('app.url') . '/objetivo/' . $d->id . '/inicio'}}" target="_blank">{{$d->start_filename}}</a>
                        @endif
                    </td>
                    <td>
                        @if ($d->end_filename)
                            <a href="{{ config('app.url') .   '/objetivo/' . $d->id . '/final'}}" target="_blank">{{$d->end_filename}}</a>
                        @endif
                    </td>
                </tr>                
            @endforeach    
        </tbody>        
    </table>    
    
</body>
</html>