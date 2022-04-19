@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Customer
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/customer" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                   
                    <div>
                        <label for="name" class="text-lg">Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="name" name="name"
                            placeholder="Name" value="{{old('name')}}">
                        @if($errors->has('name'))
                        <p class="text-center text-red-500">{{ $errors->first('name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="contactNum" class="text-lg">Contact Number</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="contactNum"
                            name="contactNum" placeholder="contactNum" value="{{old('contactNum')}}">
                        @if($errors->has('contactNum'))
                        <p class="text-center text-red-500">{{ $errors->first('contactNum') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="pics" class="text-lg">Customer Pic</label>
                        <input type="file" class="block shadow-5xl p-2 w-full" id="pics" name="pics"
                            value="{{old('pics')}}">
                        @if($errors->has('pics'))
                        <p class="text-center text-red-500">{{ $errors->first('pics') }}</p>
                        @endif
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