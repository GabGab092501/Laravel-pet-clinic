@extends('home')

@section('contents')

@if ($message = Session::get('success'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="my-3">
    <div class="text-center">
        <h1 class="text-5xl">
            Comment
        </h1>
    </div>
    <div>

        <div class="flex justify-start pt-3">
            <form action="{{ route('send') }}" method="POST">
                @csrf
                <div class="block">
                    <div>
                        <label for="name" class="text-lg">Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-3 w-screen" id="name" name="name"
                            placeholder="Name" value="{{old('name')}}">
                    </div>

                    <div>
                        <label for="email" class="text-lg">Email</label>
                        <input type="text" class="block shadow-5xl p-2 my-3 w-screen" id="email" name="email"
                            placeholder="Email" value="{{old('email')}}">
                    </div>

                    <div>
                        <label for="feedback" class="text-lg">Feedback</label>
                        <input type="text" class="block shadow-5xl p-2 my-3 w-screen" id="feedback" name="feedback"
                        placeholder="feedback" value="{{old('feedback')}}">
                            
                    </div>

                    <div style="position: absolute; left: 100%;">
                        {{-- <div> --}}
                            <select name="service_id" id="service_id" class="block shadow-5xl  w-screen">
                                @foreach ($services as $id => $service)
                                <option value="{{ $id }}">{{ $service }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-2 w-screen">
                            <button type="submit" class="bg-warning text-white font-bold p-2 mt-5 w-screen">
                                Submit
                            </button>
                            
                        </div>
                    </div>
            </form>
        </div>

        @endsection