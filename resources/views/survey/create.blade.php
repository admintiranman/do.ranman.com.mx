@extends('layouts.dashboard')
@section('title', 'Encuestas')
@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4 is-spaced">Nueva Encuesta</p>
        <hr>
        <form action="{{ route('survey.store') }}" method="post">
            @csrf
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label" for="name">Nombre:</label>
                        <div class="control @error('name') has-icons-right @enderror">
                            <input value="{{old('name')}}" type="text" name="name" class="input @error('name') is-danger @enderror">
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
                        <label for="" class="label">Nivel</label>
                        <div class="select">
                            <select name="level_id">
                                @foreach ($levels as $l)
                                    <option value="{{$l->id}}">{{$l->name}}</option>
                                @endforeach
                            </select>
                        </div>
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
