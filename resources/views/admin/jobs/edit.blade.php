@extends('layouts.dashboard')
@section('title',$job->name)

@section('dashboard-main-content')
    <section class="section">
        <p class="title is-4 is-spaced">
            Editar puesto de trabajo
        </p>    
        <form action="{{route('admin.jobs.update', $job)}}" method="post">
            @method('put')
            @csrf            
            <div class="field">
                <label class="label" for="">
                    Nombre del puesto:
                </label>
                <input type="text" name="name" value="{{$job->name}}" class="input"  id="">
            </div>       
            <div class="field">
                <label for="puesto_critico" class="checkbox">
                    Puesto Critico
                    <input type="checkbox" name="puesto_critico" id="puesto_critico">
                    
                </label>
            </div>     
            <div class="field">
                <label for="talento_clave" class="checkbox">
                    Talento Clave
                    <input type="checkbox" name="talento_clave" id="talento_clave">                    
                </label>
            </div>            
        </form>
        <hr>
        
        
        <div class="field">
            <v-competence 
                csrf="{{csrf_token()}}" 
                url_core="{{route('admin.job.add_core_competence', $job)}}"
                url_job="{{route('admin.job.add_job_competence', $job)}}"
                url_knowledge="{{route('admin.job.add_knowledge', $job)}}"
                url_experience="{{route('admin.job.add_experience', $job)}}"

                :v_data_core="{{$core_competencies}}"
                :v_data_job="{{$job_competencies}}"
                :v_data_knowledge="{{$knowledges}}"
                :v_data_experiencias="{{$experiencias}}"

                :array_job="{{$array_job}}"
                :array_knowledge="{{$array_knowledge}}"
                :array_core="{{$array_core}}"
                :array_experiences="{{$array_experiencias}}"
            >
            </v-competence>
            
        </div>
        <div class="buttons">
            <button class="button is-small is-primary" type="submit">
                <span class="icon">
                    <i class="fas fa-save"></i>
                </span>
                <span>
                    Guardar
                </span>
            </button>
        </div>

    </section>    
@endsection