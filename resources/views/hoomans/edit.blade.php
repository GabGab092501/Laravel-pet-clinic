@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Hoomans
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($hoomans,['route' => ['hoomans.update',$hoomans->id],'method'=>'PUT',  'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div>
                    <label for="name" class="text-lg">Full Name</label>
                    {{ Form::text('name',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'name')) }}
                    @if($errors->has('name'))
                    <p class="text-center text-red-500">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="email" class="text-lg">Email</label>
                    {{ Form::email('email',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'email')) }}
                    @if($errors->has('email'))
                    <p class="text-center text-red-500">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div>
                    <label for="role" class="text-lg mt-2">Pick Your Role</label>
                    {{ Form::select('role',array('Employee' => 'Employee', 'Veterinarian' => 'Veterinarian', 'Volunteer'
                    => 'Volunteer'))}}
                </div>

                <div class="grid grid-flow-col gap-2 -start w-full">
                    <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                        Submit
                    </button>
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                        role="button">Cancel</a>
                </div>
                <div>
                    <label for="images" class="block text-lg pb-3">Hoomans Pic</label>
                    {{ Form::file('images',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'images')) }}
                    <img src="{{ asset('imagefolder/hoomans/'.$hoomans->images)}}" alt="I am A Pic" width="100"
                        height="100" class="ml-24 py-2">
                    @if($errors->has('images'))
                    <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                    @endif
                </div>
            </div>
            </form>
        </div>
        @endsection