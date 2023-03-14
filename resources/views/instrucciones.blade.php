@extends('layouts.dashboard')
@section('title', 'Instrucciones')
@section('dashboard-main-content')
    <section class="section">
        {{-- <p class="title is-3">Instrucciones</p>
        <hr> --}}
        <div class="introduccion">
            <p class="introduccion-text">
                ¡Bienvenid@! <br><br>
                Esta plataforma está diseñada para que puedas tener a tu alcance todo lo relacionado al desempeño y desarrollo de tu(s) colaborador(es). Aquí encontrarás:
            </p>
            <br>
            <ol style="padding-left:35px" class="introduccion-text">
                <li><b>Objetivos Anuales:</b> sube los objetivos de inicio y cierre de año</li>                
                <li><b>Evaluación de Desempeño y Potencial:</b> evalúa si está cumpliendo con los valores, competencias y conocimientos requeridos para un buen desempeño en su puesto </li>
                <li><b>Retroalimentación y Reconocimiento:</b> en este espacio reflexiona sobre aquello que le quieres retroalimentar y reconocer</li>
                <li><b>Plan de Desarrollo Individual (PDI):</b> co-diseñen el plan que necesita para seguir desarrollándose y elevar su desempeño ¡dale seguimiento!</li>
            </ol>
            <br>
            <p class="introduccion-text">
                Todo esto <b>nos ayudará a desarrollar las competencias del futuro y seguir trascendiendo.</b>
                <br>
                <br>
                <b>A continuación,</b> completa los pasos que se encuentran en Expediente en el apartado de <a href="{{Route('user.show', Auth::user()) . '/?tab=team'}}">Equipo</a>  
            </p>
            
        </div>
    </section>
@endsection