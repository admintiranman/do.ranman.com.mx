@extends('layouts.dashboard')
@section('title', $title)
@section('dashboard-main-content')
    <section class="section">        
        <div class="columns is-mobil is-centered">
            <div class="column is-three-quarters">
                <table class="table is-fullwidth table-evaluation">
                    <thead>
                        <tr>
                            <th colspan="3">{{ $title }}</th>
                        </tr>
                    </thead>
                </table>
                <table class="table is-fullwidth table-evaluation is-bordered">
                    <thead>
                        <tr>
                            <th>Nombre del colaborador</th>
                            <th>Puesto</th>                            
                            <th>UDN</th>
                            <th>Jefe directo</th>
                        </tr>                
                    </thead>
                    <tbody>
                        <tr style="text-align:center">
                            <th>{{$objective->employee_name}}</th>
                            <th>{{$objective->job}}</th>
                            <th>{{$objective->udn}}</th>
                            <th>{{$objective->boss}}</th>                        
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr>
        </div>
        
        <div class="columns is-mobile is-centered">
            <div class="column is-three-quarters">
                <form enctype="multipart/form-data" action="{{ route('objectives.update', $objective) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="txt" value="{{$txt}}">
                    <div class="field">
                        <label class="label" for="year">Año</label>
                        <input class="input" type="text" readonly id="year" value="{{$objective->year}}">
                    </div>
                    <div class="field">
                        <label class="label" for="periodo">Periodo</label>
                        <input type="text" name="" value="{{$title}}" disabled class="input">
                    </div>

                    <div class="field">
                        <label for="comments" class="label">Commentarios</label>
                        <textarea class="textarea" name="comments" value={{old('comments')}} >
                        </textarea>
                    </div>                    
                    <div class="field">
                        <div class="file is-primary is-fullwidth is-boxed has-name">
                            <label class="file-label">
                                <input class="file-input" type="file" name="objective" onChange="fileChange(event)" accept="application/pdf" id="file">
                                <span class="file-cta">
                                    <span class="file-icon">
                                      <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                      Selecciona un PDF ...
                                    </span>
                                  </span>
                                  <span class="file-name">                                    
                                  </span>
                            </label>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="button is-small is-primary">
                            <span class="icon">
                                <i class="fa fa-save"></i>
                            </span>
                            <span>
                                Guardar Objetivos
                            </span>
                        </button>
                        <a class="button is-small is-warning" href="{{  url()->previous() }}">Regresar</a>
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
