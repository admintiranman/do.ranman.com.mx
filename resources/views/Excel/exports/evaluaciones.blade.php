@php
    $th = "font-weight: bold;font-size: 12px;";
    $title = "text-align: center;";
    $headers = ["Colaborador", "Puesto", "Unidad de negocio", "Desempeño", "Potencial", "Desempeño / Potencial", "9 Box" , "Url" ];
    
    $nine_box = [
        "Bajo" => [
            "Bajo" => [
                    "texto" => "Bajo Rendimiento", 
                    "color" => "#ff0000", 
            ],

            "Medio" => [
                "texto" => "Precaución", 
                "color" => "#f19b61", 
            ],

            "Alto" => [
                "texto" => "Estable", 
                "color" => "#ffd966", 
            ]                                    
        ], 
        "Esperado" => [

            "Bajo" => [            
                "texto" => "Precaución", 
                "color" => "#c55a11", 
            ], 
            "Medio" => [
                "texto" => "Estable", 
                "color" => "#ffc000",     
            ], 
            "Alto" => [
                "texto" => "Desarrollable", 
                "color" => "#00b0f0",     
            ], 
        ], 
        "Sobrepasa" => [
            "Bajo" => [
                "texto" => "Estable", 
                "color" => "#ffd347", 
    
            ], 
            "Medio" => [
                "texto" => "Desarrollable", 
                "color" => "#0070c0", 
            ], 
            "Alto" => [
                "texto" => "Desarrollable", 
                "color" => "#00b050",     
            ],                  
        ]    
    ];



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
            <tr>
                <th style="{{ $title . $th }}" colspan="6">Evaluaciones Realizadas</th>
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
                        <td>{{$d->x_rendimiento}}</td>
                        <td>{{$d->y_potencial}}</td>  
                        @php
                            $x = $d->x_rendimiento <= 65 ? 'Bajo' : ($d->x_rendimiento > 95 ? 'Sobrepasa' : 'Esperado'); 
                            $y = $d->y_potencial <= 75 ? 'Bajo' : ($d->y_potencial > 95 ? 'Alto' : 'Medio');
                            $bg = "background-color:" . $nine_box[$x][$y]['color'];
                        @endphp           
                        <td>
                            {{ $x }} / {{ $y }}
                        </td>           
                        <td style="{{ $bg }}">
                            {{$nine_box[$x][$y]["texto"]}}                
                        </td>
                        <td><a href="{{config('app.url').'/admin/ev/'.$d->uuid.'/show'}}">Link</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Sin datos.</td>
                    </tr>
                @endforelse
        </tbody>
    </table>
</body>
</html> 