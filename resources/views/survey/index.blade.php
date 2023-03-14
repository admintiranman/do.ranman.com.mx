@extends('layouts.dashboard')
@section('title', 'Encuestas')
@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4 is-spaced">Administración de encuestas</p>
        <hr>
        <div class="buttons">
            <a href="{{ route('survey.create') }}" class="button is-small is-link">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>
                <span>
                    Agregar Encuesta
                </span>
            </a>
        </div>
        @forelse ($surveys as $aux)
            <div class="columns">
                @foreach ($aux as $s)
                    <div class="column">
                        <div class="box">
                            <p class="subtitle is-5">{{ $s->name }}</p>                            
                            <hr>
                            <p>
                                {{ $s->description }}
                            </p>
                            <br>
                            <div class="buttons">
                                <a href="{{route('survey.get_clonar', $s)}}" class="button is-small is-primary">
                                    <span>
                                        Clonar
                                    </span>
                                </a>
                                <a target="_blank" class="button is-small is-primary" href="{{ route('survey.show', $s) }}">
                                    <span class="icon">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span>Ver</span>
                                </a>
                                <a class="button is-small is-link" href="{{ route('survey.edit', $s) }}">
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                    <span>
                                        Editar
                                    </span>
                                </a>
                                <form action="{{ route('survey.destroy', $s) }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="button is-small is-danger">
                                        <span class="icon">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span>
                                            Eliminar
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if (count($aux) == $loop->iteration && $loop->iteration%3 != 0)                    
                        @foreach (range($loop->iteration+1, 3) as $r)
                            <div class="column"></div>
                        @endforeach
                    @endif
                @endforeach
            </div> <!--end div.columns-->
        @empty
            <p>
                Sin encuestas registradas.
            </p>
        @endforelse
    </section>
@endsection
