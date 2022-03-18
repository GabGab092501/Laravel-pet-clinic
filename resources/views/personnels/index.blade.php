@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Full Name</th>
            <th class="w-screen text-3xl">Email</th>
            <th class="w-screen text-3xl">Position</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
            <th class="w-screen text-3xl">Destroy</th>
        </tr>

        @forelse ($personnels as $personnel)
        <tr>
            <td class="text-center text-3xl">
                {{ $personnel->id }}
            </td>
            <td class="text-center text-3xl">
                {{ $personnel->full_name }}
            </td>
            <td class="text-center text-3xl">
                {{ $personnel->email }}
            </td>
            <td class="text-center text-3xl">
                {{ $personnel->role }}
            </td>
            <td class=" text-center">
                <a href="personnel/{{ $personnel->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
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