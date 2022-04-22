@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Consultation
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/consultation" method="POST">
                @csrf
                <div class="block">
                    <div>
                        <label for="date" class="text-lg">Date</label>
                        <input type="date" class="block shadow-5xl p-2 my-2 w-full" id="date" name="date"
                            placeholder="Date" value="{{old('date')}}">
                        @if($errors->has('date'))
                        <p class="text-center text-red-500">{{ $errors->first('date') }}</p>
                        @endif
                    </div>

            

                    <div>
                        <label for="price" class="text-lg">Price</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="price" name="price"
                            placeholder="Price" value="{{old('price')}}">
                        @if($errors->has('price'))
                        <p class="text-center text-red-500">{{ $errors->first('price') }}</p>
                        @endif
                    </div>

                    
                    <label for="diseases_id" class="text-lg">diseases</label>
                    <select name="diseases_id" id="diseases_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($diseases as $id => $diseases)
                        <option value="{{ $id }}">{{ $diseases }}</option>
                        @endforeach
                    </select>
                    <div>
                        <label for="comment" class="text-lg">Comment</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="comment" name="comment"
                            placeholder="Comment for pets" value="{{old('comment')}}">
                        @if($errors->has('comment'))
                        <p class="text-center text-red-500">{{ $errors->first('comment') }}</p>
                        @endif
                    </div>

                    <label for="hoomans_id" class="text-lg">hoomans</label>
                    <select name="hoomans_id" id="hoomans_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($hoomans as $id => $hoomans)
                        <option value="{{ $id }}">{{ $hoomans }}</option>
                        @endforeach
                    </select>

                    <label for="pets_id" class="text-lg">pets</label>
                    <select name="pets_id" id="pets_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($pets as $id => $pets)
                        <option value="{{ $id }}">{{ $pets }}</option>
                        @endforeach
                    </select>

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