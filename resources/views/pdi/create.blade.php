@extends('layouts.dashboard')
@section('title', 'Plan De Desarrollo Individual')

@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4 is-spaced">Crear Plan de Desarrollo Individual</p>
        <hr>
        <form action="{{ route('profile.pdi.store', $profile) }}" method="post">
            @csrf
            <div class="columns">
                <div class="column">
                    <label for="name" class="label">
                        Nombre del colabor
                    </label>
                    <input readonly value="{{ $profile->user->name }}" type="text" name="nombre" class="input" required>
                </div>
                <div class="column">
                    <label for="puesto" class="label">Puesto</label>
                    <input value="{{$profile->job->name}}" type="text" name="puesto" class="input" readonly required>
                </div>
                <div class="column">
                    <label for="" class="label">Departamento</label>
                    <input type="text" name="departamento" class="input" required />
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <label class="label" for="jefe">Jefe Inmediato</label>
                    <input type="text" name="jefe_inmediato" id="jefe" required readonly class="input" value="{{ $profile->boss->user->name   }}">
                </div>
                <div class="column">
                    <label for="udn" class="label">Unidad de Negocio</label>
                    <input class="input" type="text" name="udn" id="udn" required readonly value="{{ $profile->udn->name}}" />
                </div>
                <div class="column">
                    <label for="year" class="label">Año</label>
                    <input type="number" name="year" id="year" class="input" required readonly value="{{ date('Y') + 1}}" />
                </div>
            </div>

            <v-pdi></v-pdi>
            
            
            <div class="columns">
                <div class="column">
                    <label for="comentarios" class="label">Comentarios adicionales</label>
                    <textarea name="comentarios" id="comentarios" cols="30" rows="10" class="textarea   "></textarea>
                </div>
            </div>


            

            <div class="columns">
                <div class="column">
                    <div class="buttons">
                        <button type="submit" class="button is-primary">
                            <span class="icon">
                                <i class="fas fa-save"></i>
                            </span>
                            <span>Guardar Plan de desarrollo individual</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection