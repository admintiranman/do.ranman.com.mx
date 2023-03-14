@extends('layouts.app')

@section('title', __('Reset Password'))

@section('header_style')
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <style>
        .form-reset {
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
    <div class="form-reset">

        <form action="{{route('password.email')}}" method="post">
            @if (session('status'))
                <div class="notification is-success is-light">
                    <button type="button" class="delete"></button>
                    {{ session('status') }}
                </div>
            @endif

            @csrf
            <p class="field ">
                <img src="/img/valoran.png" alt="Grupo Valoran">
            </p>
            <header>
                <p class="subtitle is-5 is-spaced">
                    {{ __('Reset Password') }}
                </p>
                <hr>
            </header>
            <div class="field">
                <label for="email" class="label">{{ __('E-Mail Address') }}</label>
                <div class="control has-icons-left @error('email') has-icons-right @enderror">
                    <input name="email" value="{{ old('email') }}" id="email" type="email" class="input @error('email') is-danger @enderror" required autocomplete="email" autofocus>
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
            <p class="field">
                <a href="{{ route('login') }}">
                    Iniciar Sesión
                </a>
            </p>
            <p>
                <button type="submit" class="button is-primary">
                    {{ __('Send Password Reset Link') }}
                </button>
            </p>
        </form>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                const $notification = $delete.parentNode;
                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>
@endsection
