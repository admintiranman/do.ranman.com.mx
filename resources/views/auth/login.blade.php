@extends('layouts.app')
@section('title', 'Inicio de sesión')

@section('header_style')
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <style>
        .form-auth {
            background-color: #ffffff;
            border-radius: 5px;
            width: 480px;
            min-height: 250px;
            margin: auto;
            margin-top: 30px;
            padding: 20px;
        }

        html {
            background-image: url('/img/background.jpg');
        }
        img {
            width: 256px;
        }        
    </style>
@endsection


@section('content')
    <div class="form-auth">
        <form action="{{route('login')}}" method="post">
            @csrf
            <p class="field">
                <img src="/img/valoran.png" alt="Grupo Valoran">
            </p>
            <header>
                <p class="subtitle is-4">
                    Iniciar Sesión
                </p>            
            </header>
            <hr>
            <div class="field">
                <label class="label" for="username">Correo Electronico</label>
                <div class="control has-icons-left @error('email') has-icons-right @enderror">
                    <input placeholder="Correo electronico" name="email" value="{{ old('email') }}" id="email" type="email" class="input @error('email') is-danger @enderror" required autocomplete="email" autofocus>
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                    @error('email')
                        <span class="icon is-small is-right">
                            <i class="fas fa-exclamation-triangle"></i>
                        </span>
                        <p class="help is-danger">
                            {{$message}}
                        </p>
                    @enderror                    
                </div>
            </div>

            <div class="field">
                <label for="" class="label">Contraseña</label>
                <p class="control has-icons-left">
                    <input required class="input" type="password" name="password" placeholder="Password">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
            </div>            
            {{-- <p class="field">
                <a href="{{route('password.request')}}">¿Olvidaste tu contraseña?</a>                
            </p>                 --}}
            <p>
                <button class="button is-primary is-fullwidth">Iniciar Sesión</button>
            </p>
        </form>
    </div>
@endsection
