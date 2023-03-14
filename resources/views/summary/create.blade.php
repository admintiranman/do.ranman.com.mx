@extends('layouts.dashboard')
@section('title', $survey->name)
@section('dashboard-main-content')
    <section class="section">        
        <div class="columns is-mobile is-centered">            
            <div class="column is-three-quarters">
                <p class="title is-4">{{ $survey->name }}</p>
                <hr>
                <form method="post" action="{{ route('survey.summary.store', [$survey]) }}">
                    @csrf
                    <input type="hidden" name="survey_id" value="{{ $survey->id }}" />
                    <div class="field">
                        <label class="label" for="text">Nombre:</label>
                        <div class="control @error('text') has-icons-right @enderror">
                            <input value="{{ old('text') }}" type="text" name="text"
                                class="input @error('text') is-danger @enderror">
                            @error('text')
                                <span class="icon is-right is-danger">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </span>
                            @enderror
                        </div>
                        @error('text')
                            <p class="is-danger help"><b>{{ $message }}</b></p>
                        @enderror
                    </div>
                    <p>
                        <v-summary-options></v-summary-options>
                    </p>
                    
                    <div class="field">
                        <button class="button is-primary" type="submit">
                            <span class="icon">
                                <i class="fa fa-save"></i>
                            </span>
                            <span>Guardar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
