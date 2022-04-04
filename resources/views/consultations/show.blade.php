@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Consultations
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($consultations,['route' => ['consultation.update',$consultations->id],'method'=>'PUT']) }}
            <div class="block">
                <div>
                    <label for="date" class="text-lg">Date</label>
                    {{ Form::date('date',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'date')) }}
                </div>

                <div>
                    <label for="disease_injury" class="text-lg">Disease or Injury</label>
                    {{ Form::text('disease_injury',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'disease_injury')) }}
                </div>

                <div>
                    <label for="price" class="text-lg">Price</label>
                    {{ Form::text('price',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'price')) }}
                </div>

                <div>
                    <label for="comment" class="text-lg">Comment</label>
                    {{ Form::text('comment',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'comment')) }}
                </div>

                <div>
                    <label for="personnel_id" class="text-lg">Type</label>
                    {!! Form::select('personnel_id',$personnels, $consultations->personnel_id ,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full', 'disabled' => true]) !!}
                </div>

                <div>
                    <label for="animal_id" class="text-lg">Type</label>
                    {!! Form::select('animal_id',$animals, $consultations->animal_id ,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full', 'disabled' => true]) !!}
                </div>

                <div class="grid w-full">
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                        role="button">Back</a>
                </div>
            </div>
            </form>
        </div>
        @endsection