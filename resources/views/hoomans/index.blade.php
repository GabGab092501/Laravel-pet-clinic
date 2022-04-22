@extends('home')

@section('contents')

<div class="py-3">
    <table class="table-auto">
        <tr class="text-black text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Full Name</th>
            <th class="w-screen text-3xl">Email</th>
            <th class="w-screen text-3xl">Position</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
 
        </tr>

        @forelse ($hoomans as $hooman)
        <tr>
            <td class="text-center text-3xl">
                <a href="{{route('hoomans.show',$hooman->id)}}">{{$hooman->id}}</a>
            </td>
            <td class="text-center text-3xl">
                {{ $hooman->name }}
            </td>
            <td class="text-center text-3xl">
                {{ $hooman->email }}
            </td>
            <td class="text-center text-3xl">
                {{ $hooman->role }}
            </td>
            <td class="pl-12">
                <img src="{{ asset('imagefolder/hoomans/'.$hooman->images)}}" alt="I am A Pic" width="75" height="75">
              </td>
            <td class=" text-center">
                <a href="hoomans/{{ $hooman->id }}/edit" class="text-center text-2xl bg-black-600 p-2">
                    Update
                </a>
            </td>
            <td class=" text-center">
                {!! Form::open(array('route' => array('hoomans.destroy', $hooman->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-2xl bg-black-600 p-2">
                    Delete  
                </button>
                {!! Form::close() !!}
            </td>
            @if($hooman->deleted_at)
            <td>
                <a href="{{ route('hoomans.restore', $hooman->id) }}">
                    <p class="text-center text-red-700 text-2xl bg-black-500 p-2">
                        Restore 
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-2xl bg-black-500 p-2">
                        Restore 
                    </p>
                </a>
            </td>
            @endif
           
        </tr>
        @empty
        <p>No hoomans Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $hoomans->links()}}</div>
</div>
</div>
@endsection