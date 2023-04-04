@extends('layouts.dashboard')
@section('title', "Administración de usuarios")
@section('dashboard-main-content')
    <section class="section">
        <h3 class="title is-4">
            Administración de usuarios
        </h3>
        
        <hr>    
        <form action="" method="GET" style="margin-bottom: 1em;">
            <b-field grouped>
                <b-field>
                    <b-input placeholder="Bucar por nombre ..."
                        type="Buscar"
                        icon="magnify"
                        name="search"
                        value="{{$search}}"    
                    >
                    </b-input>
                    <p class="control">
                        <b-button type="is-primary" label="Search" native-type="submit" />
                    </p>
                </b-field>
                <b-field>
                    <a href="{{route('user.create')}}" class="button is-primary">
                        <b-icon icon="plus"></b-icon>
                        <span>Agregar usuario</span>
                    </a>
                </b-field>
                <b-field>
                    <a href="{{route('user.export')}}" class="button is-primary">
                        <b-icon icon="download">                        
                        </b-icon>
                        <span>Descargar plantilla actual</span>
                    </a>
                </b-field>
            </b-field>
                        
        </form>
        <hr>
        <form action="{{route('user.import')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <b-field grouped>                
                <b-field>
                    <div id="file-control" class="file has-name is-fullwidth">
                        <label class="file-label">
                            <input class="file-input" type="file" name="colaboradores" required>
                            <span class="file-cta">
                              <span class="file-icon">
                                <i class="fas fa-upload"></i>
                              </span>
                              <span class="file-label">
                                Choose a file…
                              </span>
                            </span>
                            <span class="file-name">
                              No file uploaded
                            </span>
                          </label>
                      </div>                  
                </b-field>
                <b-field>
                    <button class="button is-success">
                        <b-icon icon="upload">
                        </b-icon>
                        <span>
                            Subir template
                        </span>

                    </button>
                </b-field>
    
            </b-field>
        </form>
        <hr>
        <v-table :v_data="{{$users}}">
            <b-table-column v-slot="props" label="Report ID">
                @{{props.row.report_id}}
            </b-table-column>

            <b-table-column v-slot="props" label="# nomina">
                @{{props.row.num_nomina}}
            </b-table-column>
            
            <b-table-column v-slot="props" label="Nombre">
                <a :href="`/user/${props.row.id}/edit` ">
                    @{{props.row.name}}
                </a>
            </b-table-column>

            <b-table-column v-slot="props" label="Puesto">
                @{{props.row.job.name}}
            </b-table-column>

            <b-table-column v-slot="props" label="Nivel">
                @{{props.row.level.name}}
            </b-table-column>

            <b-table-column v-slot="props" label="UDN">
                @{{props.row.udn.name}}
            </b-table-column>

            <b-table-column v-slot="props" label="Jefe directo">
                @{{props.row.boss? props.row.boss.name : ''}}
            </b-table-column>


            <b-table-column v-slot="props" label="status">
                <form :action="`/user/${props.row.id}`" method="POST">
                    @csrf
                    @method('delete')
                    <button class="button is-danger is-small" type="submit">
                        Eliminar
                    </button>
                </form>
            </b-table-column>




        </v-table>
    </section>    
@endsection


@section('javascript')
    <script>

        window.onload = () => {
            const fileInput = document.querySelector('#file-control input[type=file]');
            fileInput.onchange = () => {
                if (fileInput.files.length > 0) {
                const fileName = document.querySelector('#file-control .file-name');
                fileName.textContent = fileInput.files[0].name;
                }
            }
        }
    
    </script>
    
@endsection