@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Consultations
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($consultations,['route' => ['consultation.update',$consultations->id],'method'=>'PUT']) }}
            <div class="block">
                <div>
                    <label for="date" class="text-lg">Date</label>
                    {{ Form::date('date',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'date')) }}
                    @if($errors->has('date'))
                    <p class="text-center text-red-500">{{ $errors->first('date') }}</p>
                    @endif
                </div>

                <div>
                    <label for="disease_injury" class="text-lg">Disease or Injury</label>
                    {{ Form::select('disease_injury',array('Cataracts' => 'Cataracts', 'Arthritis' => 'Arthritis',
                    'Ear_Infections' => 'Ear_Infections', 'Kennel_Cough' => 'Kennel_Cough',
                    'Diarrhea' => 'Diarrhea', 'Fleas_and_ticks' => 'Fleas_and_ticks',
                    'Heartworm' => 'Heartworm', 'Broken_Bones' => 'Broken_Bones',
                    'Obesity' => 'Obesity', 'Cancer' => 'Cancer'))}}
                </div>

                <div>
                    <label for="price" class="text-lg">Price</label>
                    {{ Form::text('price',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'price')) }}
                    @if($errors->has('price'))
                    <p class="text-center text-red-500">{{ $errors->first('price') }}</p>
                    @endif
                </div>

                <div>
                    <label for="comment" class="text-lg">Comment</label>
                    {{ Form::text('comment',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'comment')) }}
                    @if($errors->has('comment'))
                    <p class="text-center text-red-500">{{ $errors->first('comment') }}</p>
                    @endif
                </div>

                <div>
                    <label for="hoomans_id" class="text-lg">Type</label>
                    {!! Form::select('hoomans_id',$hoomans, $consultations->hoomans_id ,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('hoomans_id'))
                    <p class="text-center text-red-500">{{ $errors->first('hoomans_id ') }}</p>
                    @endif
                </div>

                <div>
                    <label for="pets_id" class="text-lg">Type</label>
                    {!! Form::select('pets_id',$pets, $consultations->pets_id ,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('pets_id'))
                    <p class="text-center text-red-500">{{ $errors->first('pets_id ') }}</p>
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