@extends('layouts.dashboard')

@section('title', 'Documentación')

@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4 is-spaced">
            Material de apoyo
        </p>    
        <hr>
        @foreach ($data as $d)
            <div class="box">                
                <a href="{{$d->path}}" target="_blank">                    
                    <span>
                        {{$d->filename}}
                    </span>
                    <span class="icon">
                        <i class="fa fa-file-pdf"></i>    
                    </span> 
                </a>
            </div>
            @if($loop->iteration < count($data))
                <hr>
            @endif
        @endforeach
    </section>    
@endsection

