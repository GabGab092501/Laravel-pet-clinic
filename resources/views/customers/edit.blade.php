@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Customer
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($Customers,['route' => ['customer.update',$Customers->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div>
                    <label for="name" class="text-lg">Name</label>
                    {{ Form::text('name',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'name')) }}
                    @if($errors->has('name'))
                    <p class="text-center text-red-500">{{ $errors->first('name') }}</p>
                    @endif
                </div>

              

                <div>
                    <label for="contactNum" class="text-lg">Phone Number</label>
                    {{ Form::text('contactNum',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'contactNum')) }}
                    @if($errors->has('contactNum'))
                    <p class="text-center text-red-500">{{ $errors->first('contactNum') }}</p>
                    @endif
                </div>

                <div>
                    <label for="pics" class="block text-lg pb-3">Customer Pic</label>
                    {{ Form::file('pics',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'pics')) }}
                    <img src="{{ asset('uploads/customers/'.$Customers->pics)}}" alt="I am A Pic" width="100"
                        height="100" class="ml-24 py-2">
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