@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Animals
        </h1>
    </div>
    <div class="py-3">
        <table class="table-auto">
            <tr class="text-white text-center">
                <th class="w-screen text-3xl">Id</th>
                <th class="w-screen text-3xl">Animal Name</th>
                <th class="w-screen text-3xl">Age</th>
                <th class="w-screen text-3xl">Gender</th>
                <th class="w-screen text-3xl">Type of Animal</th>
                <th class="w-screen text-3xl">Owner</th>
                <th class="w-screen text-3xl">Animal Pic</th>
            </tr>

            @forelse ($animals as $animal)
            <tr>
                <td class=" text-center text-3xl">
                    {{$animal->id}}
                </td>
                <td class=" text-center text-3xl">
                    {{ $animal->animal_name }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $animal->age }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $animal->gender }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $animal->type }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $animal->first_name }}
                </td>
                <td class="pl-24">
                    <img src="{{ asset('uploads/animals/'.$animal->images)}}" alt="I am A Pic" width="75" height="75">
                </td>
            </tr>
            @empty
            <p>No Animals Data in the Database</p>
            @endforelse
        </table>
        @endsection