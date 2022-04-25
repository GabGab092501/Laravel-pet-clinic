@extends('layouts.app')

@section('content')

<div class="pt-8 pb-4 px-8">
    <a href="diseaseInjury/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new diseaseInjury &rarr;
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Disease & Injury</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
        </tr>

        @forelse ($disease_injury as $diseaseInjurys)
        <tr>
            </td>
            <td class=" text-center text-3xl">
                {{ $diseaseInjurys->id }}
            </td>
            <td class=" text-center text-3xl">
                {{ $diseaseInjurys->disease_injury }}
            </td>

            @if($diseaseInjurys->deleted_at)
            <td class=" text-center">
                <a href="#">
                    <p class="text-center text-2xl bg-green-600 p-2">
                        Update &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="diseaseInjury/{{ $diseaseInjurys->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            @endif
            <td class=" text-center">
                {!! Form::open(array('route' => array('diseaseInjury.destroy', $diseaseInjurys->id),'method'=>'DELETE'))
                !!}
                <button diseaseInjurys="submit" class="text-center text-2xl bg-red-600 p-2">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($diseaseInjurys->deleted_at)
            <td>
                <a href="{{ route('diseaseInjury.restore', $diseaseInjurys->id) }}">
                    <p class="text-center text-red-700 text-2xl bg-purple-500 py-2 mx-3">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-2xl bg-purple-500 py-2 mx-3">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @endif
        </tr>
        @empty
        <p>No Disease or Injury Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $disease_injury->links( )}}</div>
</div>
</div>
@endsection