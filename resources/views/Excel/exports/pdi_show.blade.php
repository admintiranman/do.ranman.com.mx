@php
    $header_style = "text-align:center; color: #ffffff; font-weight: bold; background-color: #002060;";

    $colors = [
        'default' => '#ffffff',
        'Por Iniciar' => '#f4b084',
        'En Proceso' => '#9bc3e6', 
        'Finalizado' => '#a9d0be'
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
    <table>
        <thead>
            <tr>

            </tr>
            <tr>
                <td></td>
                @foreach (['Nombre del colaborador', 'Puesto', 'Jefe Inmediato', 'UDN'] as $item)
                    <th style="{{$header_style}}" colspan="3">
                        {{$item}}
                    </th>                    
                @endforeach
            </tr>
            <tr>
                <td></td>
                @foreach ([$data->nombre, $data->puesto, $data->jefe_inmediato, $data->udn] as $item)
                    <td colspan="3" style="text-align:center; color:#000000; font-weight: bold;">
                        {{$item}}
                    </td>
                @endforeach
            </tr>
        </thead>
        <tbody>

            <tr>
                <th></th>
                <th style="{{$header_style}}" rowspan="2">
                    Competencia Conocimiento y/o Experiencia a desarrollar
                </th>
                <th colspan="4" style="{{$header_style}}">
                    Practica 70%
                </th>
                <th colspan="4" style="{{$header_style}}">
                    Guía 20%
                </th>
                <th colspan="3" style="{{$header_style}}">
                    Capacitacion - Formación 10%
                </th>
            </tr>
            <tr>
                <th></th>
                <th style="{{$header_style}}">Asignación crítica</th>
                <th style="{{$header_style}}">¿Quién lo acompaña?</th>
                <th style="{{$header_style}}">Fecha</th>
                <th style="{{$header_style}}">Estatus</th>

                <th style="{{$header_style}}">Coaching, Mentoring	</th>
                <th style="{{$header_style}}">¿Cada cuanto?	</th>
                <th style="{{$header_style}}">¿Quién lo acompaña?	</th>
                <th style="{{$header_style}}">Estatus</th>

                <th style="{{$header_style}}">Teoría</th>
                <th style="{{$header_style}}">Fecha</th>
                <th style="{{$header_style}}">Etatus</th>
            </tr>


            @php
                $body = json_decode($data->body);                
            @endphp

            @foreach ($body as $item)

                @php
                    $count = max(count($item->detalles->practica), count($item->detalles->guia), count($item->detalles->formacion));
                @endphp


                @if ($count > 0)                                                
                    @foreach (range(0, $count-1) as $i)
                    
                        <tr>
                            <td></td>
                            @if ($i == 0)
                                <td rowspan="{{$count}}" style="font-weight: bold; color: black; text-align: center;">
                                    {{$item->tema}}
                                </td>    
                            @endif
                            @php
                                $color = $colors[$item->detalles->practica[$i]->status??'default'];
                            @endphp

                            <td style=" background-color: {{$color}}">{{$item->detalles->practica[$i]->actividad??''}}</td>
                            <td style="text-align:center; background-color: {{$color}}">{{$item->detalles->practica[$i]->acompaniante??''}}</td>
                            <td style="text-align:center; background-color: {{$color}}">{{$item->detalles->practica[$i]->fecha??''}}</td>
                            <td style="text-align:center; background-color: {{$color}}">{{$item->detalles->practica[$i]->status??''}}</td>

                            {{-- guia --}}
                            @php
                                $color = $colors[$item->detalles->guia[$i]->status??'default'];
                            @endphp

                            <td style=" background-color: {{$color}}">{{$item->detalles->guia[$i]->actividad??''}}</td>
                            <td style="text-align:center; background-color: {{$color}}">{{$item->detalles->guia[$i]->acompaniante??''}}</td>
                            <td style="text-align:center; background-color: {{$color}}">{{$item->detalles->guia[$i]->fecha??''}}</td>
                            <td style="text-align:center; background-color: {{$color}}">{{$item->detalles->guia[$i]->status??''}}</td>


                            {{-- formacion --}}
                            @php
                                $color = $colors[$item->detalles->formacion[$i]->status??'default'];
                            @endphp

                            <td style=" background-color: {{$color}}">{{$item->detalles->formacion[$i]->actividad??''}}</td>
                            <td style="text-align:center; background-color: {{$color}}">{{$item->detalles->formacion[$i]->fecha??''}}</td>
                            <td style="text-align:center; background-color: {{$color}}">{{$item->detalles->formacion[$i]->status??''}}</td>                    
                        </tr>
                    @endforeach
                @endif
            @endforeach
        </tbody>
    </table>    
    <table>
        <thead>
            <tr>
                <td></td>
                <th style="color: black; font-weight: bold;" colspan="3" >
                    Comentarios
                </th>                
            </tr>
            <tr>
                <td></td>
                <td colspan="12" rowspan="5">

                </td>
            </tr>
        </thead>
    </table>
</body>
</html>