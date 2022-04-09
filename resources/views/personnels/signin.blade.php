@extends('layouts.app')

@section('content')
<div class="pl-24 container">
    <h1 class="text-5xl pt-24">
        Sign In
    </h1>

    <form method="POST" action="{{ route('personnel.signin') }}">
        @csrf

        <div class="row mb-3">
            <label for="email" class="col-form-label">Email Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}">

                @if($errors->has('email'))
                <p class="text-center text-red-500 pt-3 font-bold">{{ $errors->first('email') }}</p>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-form-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password">
                <div class="form-check pt-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                        ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                    @if($errors->has('password'))
                    <p class="text-center text-red-500 font-bold">{{ $errors->first('password') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6">
                <input type="submit" value="Sign In" class="btn btn-primary font-bold">
                @if (Route::has('personnel.email'))
                <a class="btn btn-link" href="{{ route('personnel.email') }}">
                    Forgot Your Password
                </a>
                @endif
                <a href="{{ route('review') }}" class="offset-sm-5 btn btn-danger text-white font-bold">Send Your
                    Feedback</a>
            </div>
        </div>
    </form>
</div>
@endsection