@extends('layouts.dashboard')
@section('title', '9 Box')
@section('header_style')
    <style>
        section {
            width: 100%;
            height: 100%;
            padding: 20px !important;
        }
        .iframe{
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
@section('dashboard-main-content')

    <section class="section">        
        <a href="{{ (route('bi.9box')) .  '?item=' . ($rep == 'current' ? 'old' : 'current') }}" >
            Ver {{ $rep != 'current' ? '2022 en adelante' : '2021 y anteriores' }}
        </a>
        <iframe class="iframe" src="{{$link}}" frameborder="0">
        </iframe> 
    </section>
@endsection