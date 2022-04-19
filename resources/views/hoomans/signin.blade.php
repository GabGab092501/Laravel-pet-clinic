@extends('welcome')

@section('contents')
<div class="pl-24 container">
    <h1 class="text-3xl pt-24">
       Log In
    </h1>

    <form method="POST" action="{{ route('hoomans.signin') }}">
        @csrf

       
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
                    <p class="text-center text-red-500 font-bold">{{ $errors->first('password') }}</p>
                    @endif
                </div>
 

    
            <div class="col-md-6">
                <input type="submit" value="Log In" class="btn btn-black font-bold">
              
                <a href="{{ route('review') }}" class="offset-sm-5 btn btn-danger text-white font-bold">Send Your
                    Feedback</a>
            </div>
       
    </form>
</div>
@endsection