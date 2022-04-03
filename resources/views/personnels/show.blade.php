@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Personnel
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($personnels,['route' => ['personnel.show',$personnels->id],'method'=>'PUT']) }}
            <div class="block">
                <div>
                    <label for="full_name" class="text-lg">Full Name</label>
                    {{ Form::text('full_name',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'full_name')) }}
                </div>

                <div>
                    <label for="email" class="text-lg">Email</label>
                    {{ Form::email('email',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'email')) }}
                </div>

                <div>
                    <label for="role" class="text-lg mt-2">Pick Your Role</label>
                    {{ Form::text('role',null,['readonly'],array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'role')) }}
                </div>

                <div class="grid w-full">
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                        role="button">Cancel</a>
                </div>
            </div>
            </form>
        </div>
        @endsection