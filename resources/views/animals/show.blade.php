@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Animals
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($animals,['route' => ['animals.show',$animals->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div>
                    <label for="animal_name" class="text-lg">Animal Name</label>
                    {{ Form::text('animal_name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'animal_name')) }}
                </div>

                <div>
                    <label for="age" class="text-lg">Age</label>
                    {{ Form::text('age',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'age')) }}
                </div>

                <div>
                    <label for="gender" class="text-lg">Gender</label>
                    {{ Form::text('gender',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'gender')) }}
                </div>

                <div>
                    <label for="type" class="text-lg">Type</label>
                    {{ Form::text('type',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'type')) }}
                </div>

                <div>
                    <label for="images" class="block text-lg pb-3">Animal Pic</label>
                    <img src="{{ asset('uploads/animals/'.$animals->images)}}" alt="I am A Pic" width="100" height="100"
                        class="ml-24 py-2">
                </div>

                <div>
                    <label for="customer_id" class="text-lg">Type</label>
                    {!! Form::select('customer_id',$customers, $animals->customer_id,['class' => 'block shadow-5xl
                    p-2 my-2 w-full', 'disabled' => true]) !!}
                </div>

                <div class="grid w-full">
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                        role="button">Cancel</a>
                </div>
            </div>
            </form>
        </div>
        @endsection