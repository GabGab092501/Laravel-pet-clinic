@extends('layouts.app')

@section('content')

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Full Name</th>
            <th class="w-screen text-3xl">Email</th>
            <th class="w-screen text-3xl">Position</th>
            <th class="w-screen text-3xl">Personnel Pic</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
            <th class="w-screen text-3xl">Destroy</th>
        </tr>

        @forelse ($personnels as $personnel)
        <tr>
            @if($personnel->deleted_at)
            <td class="text-center text-3xl">
                <a href="#">{{$personnel->id}}</a>
            </td>
            @else
            <td class="text-center text-3xl">
                <a href="{{route('personnel.show',$personnel->id)}}">{{$personnel->id}}</a>
            </td>
            @endif
            </td>
            <td class="text-center text-2xl">
                {{ $personnel->full_name }}
            </td>
            <td class="text-center text-2xl">
                {{ $personnel->email }}
            </td>
            <td class="text-center text-2xl">
                {{ $personnel->role }}
            </td>
            <td class="pl-12">
                <img src="{{ asset('uploads/personnels/'.$personnel->images)}}" alt="I am A Pic" width="75" height="75">
            </td>
            @if($personnel->deleted_at)
            <td class=" text-center">
                <a href="#">
                    <p class="text-center text-2xl bg-green-600 p-2">
                        Update &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="personnel/{{ $personnel->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            @endif
            <td class=" text-center">
                {!! Form::open(array('route' => array('personnel.destroy', $personnel->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-2xl bg-red-600 p-2">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($personnel->deleted_at)
            <td>
                <a href="{{ route('personnel.restore', $personnel->id) }}">
                    <p class="text-center text-red-700 text-2xl bg-purple-500 p-2">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-2xl bg-purple-500 p-2">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @endif
            <td>
                <a href="{{ route('personnel.forceDelete', $personnel->id) }}">
                    <p class="text-center text-2xl bg-warning p-2 mx-1"
                        onclick="return confirm('Do you want to delete this data permanently?')">
                        Destroy &rarr;
                    </p>
                </a>
            </td>
        </tr>
        @empty
        <p>No Personnel Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $personnels->links()}}</div>
</div>
</div>
@endsection