@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Vervices
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($diseaseInjury,['route' => ['diseaseInjury.update',$diseaseInjury->id],'method'=>'PUT']) }}
            <div class="block">
                <div>
                    <label for="disease_injury" class="text-lg">disease_injury</label>
                    {{ Form::text('disease_injury',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'disease_injury')) }}
                    @if($errors->has('disease_injury'))
                    <p class="text-center text-red-500">{{ $errors->first('disease_injury') }}</p>
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