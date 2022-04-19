@extends('welcome')

@section('contents')
<div class="pl-32 container w-full">

    <h1 class="text-3xl">
        Sign Up
    </h1>

    <form method="POST" action="{{ route('hoomans.signup') }}">
        @csrf

     
            <label for="name" class="col-form-label">Full Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}">

                @if($errors->has('name'))
                <p class="text-center text-red-500 pt-3 font-bold">{{ $errors->first('name') }}</p>
                @endif
            </div>
       
     
            <label for="email" class="col-form-label">Email Address</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}">

                @if($errors->has('email'))
                <p class="text-center text-red-500 pt-3 font-bold">{{ $errors->first('email') }}</p>
                @endif
            </div>
    

     
            <label for="password" class="col-form-label">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password">

                @if($errors->has('password'))
                <p class="text-center text-red-500 pt-3 font-bold">{{ $errors->first('password') }}</p>
                @endif
            </div>
     

     
            <label for="password-confirm" class="col-form-label">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            </div>
      

     
            <label for="role" class="col-form-label">Pick Your Role</label>
            <div class="col-md-6">
                <select name="role" id="role" class="form-select" value="{{old('role')}}">
                    <option>Employee</option>
                    <option>Veterinarian</option>
                    <option>Volunteer</option>
                </select>
            </div>
     
        <div class="row">
            <div class="col-md-6">
                <input type="submit" value="Sign Up" class="btn btn-black">
                <a href="{{url()->previous()}}" class="btn btn-danger" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection