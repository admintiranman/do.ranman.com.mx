@extends('layouts.dashboard')
@section('title', 'Encuestas')
@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4 is-spaced">Clonar encuesta <b>{{$survey->name }}</b></p>
        <hr>
        <form action="{{ route('survey.clonar', $survey) }}" method="post">
            @csrf
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="name">Nombre:</label>
                        <div class="control @error('name') has-icons-right @enderror">
                            <input value="{{old('name')}}" type="text" name="name" class="input is-small @error('name') is-danger @enderror">
                            @error('name')
                            <span class="icon is-small is-right is-danger">
                                <i class="fas fa-exclamation-triangle"></i>
                            </span>
                            @enderror
                        </div>
                        @error('name')
                            <p class="is-danger help"><b>{{$message}}</b></p>
                        @enderror                    
                    </div>
                </div>

                <div class="column">
                    <div class="field">
                        <label class="label" for="level">Nivel</label>
                        <div class="control is-expanded">
                            <div class="select is-fullwidth is-small @error('level_id') is-danger @enderror">
                                <select name="level_id" id="level">
                                    <option value=""></option>
                                    @foreach ($levels as $l)
                                        <option {{$l->id ==  old('level_id') ? "selected": ""}} value="{{ $l->id }}">{{ $l->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @error('level_id')
                        <p class="help is-danger"><b>{{$message}}</b></p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="field">
                <label for="description" class="label">Desripcion</label>
                <textarea class="textarea" name="description" id="description" cols="30" rows="10">{{old('description')}}</textarea>
            </div>


            <div class="field">
                <button type="submit" class="button is-small is-primary">
                    <span class="icon">
                        <i class="fa fa-save"></i>
                    </span>
                    <span>Guardar</span>
                </button>
            </div>
        </form>
    </section>
@endsection
