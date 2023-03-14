@php
    $path = Request::path();
    $user = Auth::user();
@endphp


<div class="dashboard-panel is-small sidebar-background">
    <header class="dashboard-panel-header">
        <img src="/img/valoran.png" alt="logo valoran">
    </header>

    <div class="dashboard-panel-content">
        <b-menu>
            @role('Administrador')
            <b-menu-list label="Administración">
                <li>
                    <a href="{{route('admin.dashboard.index')}}">Dashboard</a>
                </li>
                <li>
                    <a href="{{route('admin.jobs.index')}}">Puestos de trabajo</a>
                </li>                    
                <li>
                    <a href="{{route('survey.index')}}">
                        Encuestas
                    </a>
                </li>    
                <li>
                    <a href="{{route('admin.evaluaciones.index')}}">
                        Evaluaciones
                    </a>
                </li>

                <li>
                    <a href="{{route("user.index")}}">
                        Usuarios
                    </a>
                </li>

              <b-menu-item icon="account-multiple" label="Organigramas">                                
                <li>
                    <a href="{{route('admin.organigrama', 'FN')}}">Nutriendo</a>
                </li>

                <li>
                    <a href="{{route('admin.organigrama', 'GV')}}">Valoran</a>
                </li>

                <li>
                    <a href="{{route('admin.organigrama', 'VEXA')}}">VEXA</a>
                </li>            
                
                <li>
                    <a href="{{route('admin.organigrama', 'XCALAK')}}">XCALAK</a>
                </li>
                
            </b-menu-list>
            
            @endrole
            <br>
            <b-menu-list>

            <b-menu-list label="{{$user->name}}" icon="account">
                <li>
                    <a href="/instrucciones">
                        Instrucciones
                    </a>
                </li>
                <li>
                    <a @if( str_contains($path,  "profile")) class="is-active" @endif  href="{{route('user.show', $user)}}">Expediente</a>
                </li>
                @if ($user->team->count() > 0 || $user->hasRole('Administrador'))
                    <li>
                        <a href="{{route('bi.9box')}}">9 box</a>
                    </li>
                    <li>
                        <a href="{{route('team.organigrama')}}">Organigrama</a>
                    </li>
                    
                @endif            
                <li>
                    <a href="{{route('documentation.index')}}">                            
                        Material de apoyo       
                    </a>                    
                </li>

                <li>
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <br>
                        <button class="button is-small is-danger" type="submit">
                            <span class="icon">
                                <i class="fas fa-sign-out"></i>
                            </span>
                            <span>
                                Cerrar Sesión
                            </span>
                        </button>
                    </form>
                </li>
                
                
            </b-menu-list>
          </b-menu>
    </div>


</div>
