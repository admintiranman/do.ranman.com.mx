@extends('layouts.dashboard')
@section('title', $survey->name)
@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4">{{ $survey->name }}</p>
        <hr>
        <div class="buttons">
            <a class="button is-small is-link" href="{{ route('survey.summary.create', [$survey]) }}">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>
                <span>Agregar Sección</span>
            </a>
        </div>
        @foreach ($survey->summaries()->get() as $summary)
            <table class="table is-striped is-bordered is-fullwidth">
                <thead>
                    <tr>
                        <th>
                            {{$summary->text}}
                        </th>
                        <th>
                            <div class="buttons">
                                <a href="{{route('survey.summary.subsummary.create', [$survey, $summary])}}" class="button is-small is-primary">
                                    <span class="icon">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                    <span>
                                        Agregar subtema
                                    </span>
                                </a>
                                <a href="" class="button is-small is-warning">
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                    <span>
                                        Editar
                                    </span>
                                </a>
                                <form action="{{route('survey.summary.destroy', [$survey, $summary])}}" method="post">
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
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($summary->subsummaries()->get() as $subsummary)
                        <tr>
                            <td rowspan="{{$subsummary->questions()->count()+1}}">
                                {!!$subsummary->text!!}
                                <br>
                                <button type="submit" style="background: transparent; border: none; ">
                                    
                                    
                                    <a href="{{route('subsummary.question.create', [$subsummary])}}">
                                        <span>Agregar pregunta</span>
                                        <b-icon icon="plus" size="is-small"></b-icon>
                                    </a>

                                </button>
                                <form method="POST" action="{{route('survey.summary.subsummary.destroy', [$survey, $summary, $subsummary])}}">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" style="background: transparent; border: none; ">
                                        <a href="" onclick="">
                                            <span>Eliminar</span>
                                            <b-icon icon="delete" size="is-small"></b-icon>
                                        </a>                
                                    </button>
                                </form>
                            </td>

                            @forelse($subsummary->questions()->get() as $question)
                                <tr>
                                    <td>
                                        
                                        {!!$question->text!!}
                                        <br>                                        
                                        <div class="buttons">
                                            <a class="" href="{{route('subsummary.question.edit', [$subsummary,$question])}}">
                                                <span>Editar</span>                                                
                                                <b-icon icon="pencil" size="is-small"></b-icon>
                                            </a>
                                            
                                            &nbsp;&nbsp; | &nbsp;&nbsp;
                                            <form action="{{route('subsummary.question.destroy', [$subsummary, $question])}}" method="post">
                                                @csrf
                                                @method("delete")
                                                <button type="submit" style="background: transparent; border: none; ">
                                                    <a href="" onclick="">
                                                        <span>Eliminar</span>
                                                        <b-icon icon="delete" size="is-small"></b-icon>
                                                    </a>                
                                                </button>
                                                                                
                                            </form>
                                        </div>                                                                                                                                 
                                    </td>
                                </tr>
                            @empty
                                <td>Sin preguntas</td>                            
                            @endforelse
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">Sin Subtemas</td> 
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endforeach

    </section>
@endsection
