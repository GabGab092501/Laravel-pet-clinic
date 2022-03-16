@extends('body')

@section('contents')

@if ($message = Session::get('success'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="my-3">
    <div class="text-center">
        <h1 class="text-5xl">
            Send Us Your Feedback
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="{{ route('send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div>
                        <label for="name" class="text-lg">Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-3 w-full" id="name" name="name"
                            placeholder="Full Name" value="{{old('name')}}">
                    </div>

                    <div>
                        <label for="email" class="text-lg">Email</label>
                        <input type="text" class="block shadow-5xl p-2 my-3 w-full" id="email" name="email"
                            placeholder="Email" value="{{old('email')}}">
                    </div>

                    <div>
                        <label for="phone_number" class="text-lg">Phone Number</label>
                        <input type="text" class="block shadow-5xl p-2 my-3 w-full" id="phone_number"
                            name="phone_number" placeholder="Phone Number" value="{{old('phone_number')}}">
                    </div>

                    <div>
                        <label for="review" class="text-lg">Message Us</label>
                        <textarea id="review" name="review" class="block shadow-5xl p-2 my-3 w-full" rows="4" cols="50"
                            placeholder="Leave Your Message Here" value="{{old('review')}}"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-2 w-full">
                        <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                            Submit
                        </button>
                        <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                            role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

        @endsection