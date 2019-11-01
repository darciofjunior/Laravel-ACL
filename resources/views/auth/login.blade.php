@extends('auth.templates.template')

@section('content-form')

<form class="login form" method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group row">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group row">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group row mb-0">
        <button type="submit" class="btn btn-login">
            {{ __('Login') }}
        </button>
    </div>

    <div class="form-group text-right">
        <a class="recuperar" href="{{ route('password.request') }}">
            Recuperar Senha
        </a>
    </div>
</form>

@endsection
