@extends('layouts.dashboard')
@section('title', $survey->name)


@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4">{{$survey->name}} ({{$survey->level->name??''}})</p>
        <p class="subtitle is-5">{{$summary->text}}</p>
        <hr>
        <form method="post" action="{{route('survey.summary.subsummary.store', [$survey, $summary])}}">
            @csrf
            <input type="hidden" name="survey_id" value="{{$survey->id}}" />
            <div class="columns">
                <div class="column is-6">
                    <div class="field">
                        <label class="label" for="text">Nombre:</label>
                        <div class="control @error('text') has-icons-right @enderror">
                            <input value="{{old('text')}}" type="text" name="text" class="input is-small @error('text') is-danger @enderror">
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