@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Services
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($services,['route' => ['service.show',$services->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div>
                    <label for="service_name" class="text-lg">First Name</label>
                    {{ Form::text('service_name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'service_name')) }}
                </div>

                <div>
                    <label for="cost" class="text-lg">Cost</label>
                    {{ Form::text('cost',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'cost'))
                    }}
                </div>

                <div>
                    <label for="images" class="block text-lg pb-3">Service Pic</label>
                    <img src="{{ asset('uploads/services/'.$services->images)}}" alt="I am A Pic" width="100"
                        height="100" class="ml-24 py-2">
                </div>


                <div class="grid w-full">
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                        role="button">Back</a>
                </div>
            </div>
            </form>
        </div>
        @endsection