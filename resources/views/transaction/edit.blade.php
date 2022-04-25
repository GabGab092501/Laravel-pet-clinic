@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Transaction
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($transactions,['route' => ['transaction.update',$transactions->id],'method'=>'POST']) }}
            <div class="block">
                <div>
                    <label for="date" class="text-lg">Date</label>
                    {{ Form::text('date',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'date')) }}
                    @if($errors->has('date'))
                    <p class="text-center text-red-500">{{ $errors->first('date') }}</p>
                    @endif
                </div>

                <div>
                    <label for="personnel_id" class="text-lg">Vet</label>
                    {!! Form::select('personnel_id',$personnels, $transactions->personnel_id,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('personnel_id'))
                    <p class="text-center text-red-500">{{ $errors->first('personnel_id') }}</p>
                    @endif
                </div>

                <div>
                    <label for="animal_id" class="text-lg">Pet</label>
                    {!! Form::select('animal_id',$animals, $transactions->animal_id,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('animal_id'))
                    <p class="text-center text-red-500">{{ $errors->first('animal_id') }}</p>
                    @endif
                </div>

                <div>
                    <label for="service_id" class="text-lg">Type of Service</label>
                    {!! Form::select('service_id',$services, $transactions->service_id,['class' => 'block
                    shadow-5xl
                    p-2
                    my-2
                    w-full']) !!}
                    @if($errors->has('service_id'))
                    <p class="text-center text-red-500">{{ $errors->first('service_id') }}</p>
                    @endif
                </div>

                <div>
                    <label for="status" class="text-lg mt-2">Status</label>
                    {{ Form::select('status',array('Not Paid' => 'Not Paid', 'Pending' => 'Pending',
                    'Paid'
                    => 'Paid'))}}
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