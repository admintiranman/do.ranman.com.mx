@extends('layouts.dashboard')
@section('title', 'Retroalimentación')
@section('dashboard-main-content')
    <section class="section">
        <h2 class="title is-2">Retroalimentación</h2>
        <table class="table is-fullwidth table-evaluation is-bordered">
            <thead>
                <tr>
                    <th>Nombre del colaborador</th>
                    <th>Puesto</th>
                    <th>UDN</th>
                    <th>Jefe directo</th>
                </tr>                
            </thead>
            <tbody>
                <tr >
                    <th style="text-align:center">{{$retro->employee_name}}</th>
                    <th style="text-align:center">{{$retro->job}}</th>
                    <th style="text-align:center">{{$retro->udn}}</th>
                    <th style="text-align:center">{{$retro->boss}}</th>
                </tr>
            </tbody>
        </table>
        <hr>
        <p class="title is-4">
            Considerando la evaluación del perfil de puesto y la de desempeño y potencial, contesta lo siguiente...       
        </p>
        <hr>
        <form action="{{route('retro.update',  $retro)}}" method="post">
            @csrf
            @method('put')
            <div class="field">
                <label for="respuesta1" class="label" style="font-size: 20px !important;">
                    ¿Qué le quiero reconocer?
                </label>
                <p style="font-size: 16px;">
                    Cuáles serían esos temas (competencias, valores, conocomientos, etc) en los que se observa un alto desempeño/potencial
                </p>
                @if ($retro->lock)
                    <p style="font-size: 18px">
                        {!! preg_replace('/\n/', "<br />", $retro->respuesta1) !!}
                    </p>
                @else
                    <textarea name="respuesta1" id="respuesta1" cols="30" rows="5" class="textarea">{{$retro->respuesta1}}</textarea>    
                @endif
                
            </div>
            <div class="field">
                <label for="respuesta2" class="label" style="font-size: 20px !important;">¿Qué le falta desarrollar?</label>                    
                <p style="font-size: 16px;">Cuáles serían esos temas (competencias, valores, conocimientos, etc) específicos a trabajar con él/ella para elevar su desempeño/potencial</p>

                @if ($retro->lock)
                    <p style="font-size: 18px">
                        {!! preg_replace('/\n/', "<br />", $retro->respuesta2) !!}
                    </p>
                @else
                    <textarea name="respuesta2" id="respuesta2" cols="30" rows="5" class="textarea">{{$retro->respuesta2}}</textarea>    
                @endif
            </div>
            <div class="field">
                <div class="buttons">
                    <button type="submit" class="button is-primary">
                        <span class="icon">
                            <i class="fas fa-save"></i>
                        </span>
                        <span>
                            Guardar
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </section>
@endsection