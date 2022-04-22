@extends('home')

@section('contents')

<body>
   
    <div class="py-3">
        <h1 class="text-center text-black-600 text-3xl font-bold py-3">History</h1>
   
        <table class="table-auto">
            <tr class="text-black text-center">
                <th class="w-screen text-4xl">Animal</th>
                <th class="w-screen text-4xl">Date</th>
                <th class="w-screen text-4xl">Disease or Injury</th>
                <th class="w-screen text-4xl">Vet</th>
                <th class="w-screen text-4xl">Comment</th>
            </tr>
            @forelse ($consultations as $consultation)
            <tr>
                <td class=" text-center text-4xl">
                    {{ $consultation->pets_name }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $consultation->date }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $consultation->diseases }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $consultation->name }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $consultation->comment }}
                </td>
                @empty
                <p class="text-center text-4xl py-8">Data is empty</p>
                @endforelse
        </table>
    </div>
    </tr>
    <div class="flex justify-end">
        <a href="{{url()->previous()}}" class="bg-gray-800 text-black text-2xl font-bold p-2 mr-10 text-center"
            role="button">Go Back &rarr;</a>
    </div>
</body>
@endsection