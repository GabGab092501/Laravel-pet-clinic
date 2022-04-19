@extends('home')

@section('contents')

@if ($message = Session::get('error'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="pt-8 pb-4 px-8">
    <a href="consultation/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new consultation &rarr;
    </a>

</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Date</th>
            <th class="w-screen text-3xl">disease or Injury</th>
            <th class="w-screen text-3xl">price</th>
            <th class="w-screen text-3xl">Comment</th>
            <th class="w-screen text-3xl">Vet</th>
            <th class="w-screen text-3xl">ws</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
            <th class="w-screen text-3xl">Destroy</th>
        </tr>

        @forelse ($consultations as $consultation)
        <tr>
            <td class="text-black text-center text-2xl">
                <a href="{{route('consultation.show',$consultation->id)}}">{{$consultation->id}}</a>
            </td>
            <td class="text-black text-center text-2xl">
                {{ $consultation->date }}
            </td>
            <td class="text-black text-center text-2xl">
                {{ $consultation->disease_injury }}
            </td>
            <td class="text-black text-center text-2xl">
                {{ $consultation->price }}
            </td>
            <td class="text-black text-center text-2xl">
                {{ $consultation->comment }}
            </td>
            <td class="text-black text-center text-2xl">
                {{ $consultation->full_name }}
            </td>
            <td class="text-black text-center text-2xl">
                {{ $consultation->animal_name }}
            </td>
            <td class="text-center">
                <a href="consultation/{{ $consultation->id }}/edit" class="text-center text-xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            <td class="text-center">
                {!! Form::open(array('route' => array('consultation.destroy', $consultation->id),'method'=>'DELETE'))
                !!}
                <button type="submit" class="text-center text-xl bg-red-600 p-2 my-2">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($consultation->deleted_at)
            <td>
                <a href="{{ route('consultation.restore', $consultation->id) }}">
                    <p class="text-center text-red-700 text-lg bg-purple-500 p-2">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-lg bg-purple-500 p-2">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @endif
            <td>
                <a href="{{ route('consultation.forceDelete', $consultation->id) }}">
                    <p class="text-center text-lg bg-warning p-2 m-2"
                        onclick="return confirm('Do you want to delete this data permanently?')">
                        Destroy &rarr;
                    </p>
                </a>
            </td>
        </tr>
        @empty
        <p>No Consultation Data in the Database</p>
        @endforelse
    </table>

    <span class="flex justify-center pt-6">
        <form action="{{ url('results') }}" type="GET">
            <input type="result" name="result" id="result" class="text-center pb-1 px-2 w-full">
            <div class="grid w-full">
                <button class="bg-green-800 text-black font-bold p-2 mt-3">Search</button>
            </div>
    </span>

    <div class="pt-6 px-4">{{ $consultations->links( )}}</div>
</div>
</div>
@endsection