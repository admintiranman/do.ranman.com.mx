@extends('layouts.dashboard')
@section('title', 'Organigrama')
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
        <org-chart :pan="true" :zoom="true" :data="{{$team}}">        
            {{-- <template slot-scope="{nodeData}">
                <div style="background-color: #ff0032; color: #ffffff;">
                    @{{nodeData.name}}
                </div>                
            </template> --}}
        </org-chart>
    </section>    
@endsection



