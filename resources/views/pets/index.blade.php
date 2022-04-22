@extends('home')

@section('contents')

<div class="pt-8 pb-4 px-8">
    <a href="pets/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new pets 
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-black text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Pets Name</th>
            <th class="w-screen text-3xl">Age</th>
            <th class="w-screen text-3xl">Gender</th>
            <th class="w-screen text-3xl">classify of pets</th>
            <th class="w-screen text-3xl">Owner</th>
            <th class="w-screen text-3xl">pets Pic</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
        </tr>

        @forelse ($pets as $pet)
        <tr>
           @if($pet->deleted_at)
      <td class="text-center text-3xl">
        <a href="#">{{$pet->id}}</a>
      </td>
      @else
      <td class="text-center text-3xl">
        <a href="{{route('pets.show',$pet->id)}}">{{$pet->id}}</a>
      </td>
      @endif
      </td>
            <td class=" text-center text-3xl">
                {{ $pet->pets_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $pet->age }}
            </td>
            <td class=" text-center text-3xl">
                {{ $pet->gender }}
            </td>
            <td class=" text-center text-3xl">
                {{ $pet->classify }}
            </td>
            <td class=" text-center text-3xl">
                {{ $pet->name }}
            </td>
            <td class="pl-10">
                <img src="{{ asset('uploads/pets/'.$pet->images)}}" alt="I am A Pic" width="75" height="75">
            </td>
            @if($pet->deleted_at)
            <td class=" text-center">
              <a href="#">
                <p class="text-center text-2xl bg-green-600 p-2">
                  Update &rarr;
                </p>
              </a>
            </td>
            @else
            <td>
              <a href="pets/{{ $pet->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                Update &rarr;
              </a>
            </td>
            @endif
      
            <td class=" text-center">
                {!! Form::open(array('route' => array('pets.destroy', $pet->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-lg bg-black-600 p-2">
                    Delete 
                </button>
                {!! Form::close() !!}
            </td>
            @if($pet->deleted_at)
            <td>
                <a href="{{ route('pets.restore', $pet->id) }}">
                    <p class="text-center text-red-700 text-lg bg-black-500 p-2">
                        Restore 
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-lg bg-black-500 p-2">
                        Restore 
                    </p>
                </a>
            </td>
            @endif
           
        </tr>
        @empty
        <p>No pets Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $pets->links()}}</div>
</div>
</div>
@endsection