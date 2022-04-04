@extends('body')

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
                        <label for="disease_injury" class="text-lg">Disease or Injury</label>
                        <select name="disease_injury" id="disease_injury" class="block shadow-5xl p-2 my-2 w-full"
                            value="{{old('disease_injury')}}">
                            <option>Cataracts</option>
                            <option>Arthritis</option>
                            <option>Ear_Infections</option>
                            <option>Kennel_Cough</option>
                            <option>Diarrhea</option>
                            <option>Fleas_and_ticks</option>
                            <option>Heartworm</option>
                            <option>Broken_Bones</option>
                            <option>Obesity</option>
                            <option>Cancer</option>
                        </select>
                    </div>

                    <div>
                        <label for="price" class="text-lg">Price</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="price" name="price"
                            placeholder="Price" value="{{old('price')}}">
                        @if($errors->has('price'))
                        <p class="text-center text-red-500">{{ $errors->first('price') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="comment" class="text-lg">Comment</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="comment" name="comment"
                            placeholder="Comment for Animal" value="{{old('comment')}}">
                        @if($errors->has('comment'))
                        <p class="text-center text-red-500">{{ $errors->first('comment') }}</p>
                        @endif
                    </div>

                    <label for="personnel_id" class="text-lg">Personnel</label>
                    <select name="personnel_id" id="personnel_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($personnels as $id => $personnel)
                        <option value="{{ $id }}">{{ $personnel }}</option>
                        @endforeach
                    </select>

                    <label for="animal_id" class="text-lg">Animals</label>
                    <select name="animal_id" id="animal_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($animals as $id => $animal)
                        <option value="{{ $id }}">{{ $animal }}</option>
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