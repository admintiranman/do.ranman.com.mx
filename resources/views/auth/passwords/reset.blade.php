@extends('layouts.app')
@section('titulo', __('Reset Password'))

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
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <p class="field ">
                <img src="/img/ranman.png" alt="Grupo Valoran">
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
                    <input readonly id="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
                <label for="password" class="label">{{ __('Password') }}</label>
                <div class="control has-icons-left @error('password') has-icons-right @enderror">
                    <input id="password" type="password" class="input @error('password') is-danger @enderror" name="password" required autocomplete="password">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                    @error('password')
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
                <label for="password-confirm" class="label">{{ __('Confirm Password') }}</label>
                <div class="control has-icons-left">
                    <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
            </div>
            <div class="field">
                <button type="submit" class="button is-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
@endsection


{{-- old code generated by Laravel framework.
    
@extends('layouts.app')

@section('contents')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
