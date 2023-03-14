@php
    $bold = 'font-weight: bold;';
    $white = 'color: #ffffff;';
    $font_size_header = 'font-size: 12px;';
    $center = "text-align: center;";
    $th = "$bold background-color: #002060; $white $font_size_header padding: 7px; $center";


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
            <tr></tr>
            <tr style="text-align:center">
                <th></th>
                <th colspan="2" style="{{ $th }}">Nombre del colaborador</th>
                <th colspan="3" style="{{ $th }}">Puesto</th>
                <th colspan="2" style="{{ $th }}">UDN</th>
                <th colspan="2" style="{{ $th }}">Jefe dircto</th>
            </tr>
            <tr style="text-align:center">
                <td></td>
                <td colspan="2" style="{{ $bold . $font_size_header . $center }}">{{ $ev->employee_name }}</td>
                <td colspan="3" style="{{ $bold . $font_size_header . $center }}">{{ $ev->job }}</td>
                <td colspan="2" style="{{ $bold . $font_size_header . $center }}">{{ $ev->udn }}</td>
                <td colspan="2" style="{{ $bold . $font_size_header . $center }}">{{ $ev->boss }}</td>
            </tr>
            <tr style="text-align:center; height: 60px;">
                <td></td>
                <th colspan="2" style="{{ $th }} text-align:center;">Evaluado por</th>
                <th colspan="3" style="{{ $th }}">Desempeño / Potencial</th>
                <th colspan="2" style="{{ $th }}"> 9 Box</th>
            </tr>
            <tr style="text-align:center">
                <td></td>
                <td colspan="2" style="{{ $bold . $font_size_header . $center }}">{{ $ev->evaluated_by }}</td>
                @php
                    $x = $ev->x_rendimiento <= 65 ? 'Bajo' : ($ev->x_rendimiento > 95 ? 'Sobrepasa' : 'Esperado'); 
                    $y = $ev->y_potencial <= 75 ? 'Bajo' : ($ev->y_potencial > 95 ? 'Alto' : 'Medio');
                    $bg = "background-color:" . $nine_box[$x][$y]['color'];
                @endphp
                <td colspan="3" style="{{ $bold . $font_size_header . $center }}">
                    {{ $x }} / {{ $y }}
                </td>
                <td colspan="2" style="{{ $bold . $font_size_header . $center  . $bg }}">
                    {{$nine_box[$x][$y]["texto"]}}                
                </td>
            </tr>
        </thead>        
    </table>

    @php
        $survey = json_decode($ev->survey);
    @endphp

    @foreach ($survey as $summary)
        <table border="1" style="border: 2px solid green;">            
                <tr>
                    <th colspan="2" style="{{ $th }}">
                        {{ $summary->text }}
                    </th>
                    <th style="{{ $th }}">
                        Pregunta
                    </th>
                    @foreach ($summary->options as $option)
                        <th style="{{ $th }}">
                            {{ $option->text }}
                        </th>
                    @endforeach
                    <th style="{{ $th }}">
                        Comentarios
                    </th>
                </tr>                        
                @foreach ($summary->subsummaries as $s)
                    <tr>                        
                        @php
                            $row = count($s->questions);                            
                        @endphp
                        <td style="text-align:center" rowspan="{{ $row }}">
                            {{ $loop->index + 1 }}
                        </td>
                        <td style="text-align:center" rowspan="{{ $row }}">
                            {!! $s->text !!}
                        </td>      
                    </tr>      
                    <table>
                        @foreach ($s->questions as $q)
                            <tr>
                                <td style="text-align:leftm border: 1px solid grey; !important; background-color:{{ $q->color ?? '#ffffff' }}">
                                    {!! $q->text !!}
                                </td>
                                @foreach ($summary->options as $option)
                                    <td style="text-align:center">
                                        @if ($option->value == ($q->value ?? 0))
                                            X
                                        @endif
                                    </td>
                                @endforeach
                                <td>
                                    {{ $q->comments ?? '' }}
                                </td>
                            </tr>
                        @endforeach                                
                    </table>                    
                @endforeach            
        </table>
    @endforeach
</body>
</html>