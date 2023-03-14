@extends('layouts.dashboard')

@section('title', 'Agregar Objetivo')

@section('dashboard-main-content')

    <section class="section">
        <p class="title is-4 is-spaced">
            Crear Objetivos
        </p>
        <hr>
        <div class="columns is-mobile is-centered">
            <div class="column is-half">
                <form enctype="multipart/form-data" action="{{ route('objectives.store') }}" method="post">
                    @csrf

                    <div class="field">
                        <label class="label" for="year">Año</label>
                        <input class="input" type="number" value="{{old('year')??date('Y')}}" name="year" min="{{ date('Y') - 1 }}" max="{{ date('Y') + 1 }}" id="">
                    </div>

                    <div class="field">
                        <label for="start_lock" class="checkbox">
                            <input checked type="checkbox" name="start_lock" id="start_lock">
                            Permitir cargar objetivos iniciales
                            
                        </label>
                    </div>
                    <div class="field">
                        <label for="end_lock" class="checkbox">
                            <input type="checkbox" name="end_lock" id="end_lock">  
                            Permitir cargar objetivos finales
                            
                        </label>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="button is-small is-primary">
                            <span class="icon">
                                <i class="fa fa-save"></i>
                            </span>
                            <span>
                                Generar Objetivos
                            </span>
                        </button>
                        <a class="button is-small is-warning" href="{{ route('objectives.index') }}">Regresar</a>
                    </div>
                </form>
            </div>
        </div>

    </section>
@endsection


@section('javascript')
    <script type="text/javascript">        
        function fileChange(event) {
            let {target} = event;
            let filename = document.querySelector('.file-name');
            if(target.files.length > 0) {
                filename.textContent = target.files[0].name;
            }
            else {
                filename.textContent = "archivo no subido"
            }   
        }
    </script>  
@endsection
