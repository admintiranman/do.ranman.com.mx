@extends('layouts.dashboard')
@section('title', $subsummary->summary->survey->name)
@section('header_style') 
    <script src="https://cdn.tiny.cloud/1/zlkg9k3l5crlo72avh397dylmgk357v3i895c5u9yocmq7a3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>  
    <script>tinymce.init({selector:'textarea'});</script>
@endsection
@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4">{{$subsummary->summary->survey->name}}</p>
        <p class="subtitle is-5">{{$subsummary->summary->text}} | {{$subsummary->text}}</p>
        <hr>
        <form method="post" action="{{route('subsummary.question.store', [$subsummary])}}">
            @csrf
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="text">Texto:</label>
                        <div class="control @error('text') has-icons-right @enderror">
                            <textarea name="text" id="text" class="textarea @error('text') is-danger @enderror" cols="30" rows="10">{{old('text')}}</textarea>
                            
                            @error('text')
                            <span class="icon is-small is-right is-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror
                        </div>
                        @error('text')
                            <p class="is-danger help"><b>{{$message}}</b></p>
                        @enderror                    
                    </div>                    
                </div>
                <div class="column">
                    <div class="field">
                        <label for="comentarios" class="label">¿Habilitar comentarios?</label>
                        <input type="checkbox" name="comentarios" @if(old('comentarios')) checked @endif>
                    </div>
                </div>
            </div>
            <div class="field">
                <button class="button is-small is-primary" type="submit">
                    <span class="icon">
                        <i class="fa fa-save"></i>
                    </span>
                    <span>Guardar</span>
                </button>
            </div>
        </form>
    </section>
@endsection