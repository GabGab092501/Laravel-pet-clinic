@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Service
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/service" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div>
                        <label for="service_name" class="text-lg">Service Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="service_name"
                            name="service_name" placeholder="Service Name" value="{{old('service_name')}}">
                        @if($errors->has('service_name'))
                        <p class="text-center text-red-500">{{ $errors->first('service_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="cost" class="text-lg">Cost</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="cost" name="cost"
                            placeholder="Cost" value="{{old('cost')}}">
                        @if($errors->has('cost'))
                        <p class="text-center text-red-500">{{ $errors->first('cost') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="images" class="text-lg">Service Pic</label>
                        <input type="file" class="block shadow-5xl p-2 w-full" id="images" name="images"
                            value="{{old('images')}}">
                        @if($errors->has('images'))
                        <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
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