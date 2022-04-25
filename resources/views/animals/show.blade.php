@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Animals
        </h1>
    </div>
    @forelse ($animals as $animal)
    <section class="flex flex-wrap justify-center gap-3 p-12 w-full">
        <div
            class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <img src="{{ asset('uploads/animals/'.$animal->images)}}" alt="I am A Pic" width="400"
                style="max-height: 12rem;">
            <div class="p-3">
                <h5 class="mb-2 text-2xl font-bold text-center tracking-tight">{{ $animal->animal_name }}
                </h5>
                ID<p class="mb-2 text-lg font-bold">{{ $animal->id }}</p>
                Age<p class="mb-2 text-lg font-bold">{{ $animal->age }}</p>
                Gender<p class="mb-2 text-lg font-bold">{{ $animal->gender }}</p>
                Type<p class="mb-2 text-lg font-bold">{{ $animal->type }}</p>
                Owner<p class="mb-2 text-lg font-bold">{{ $animal->first_name }}</p>
            </div>
        </div>
    </section>
    {{-- <div class="py-3">
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
            </tr> --}}
            @empty
            <p>No Animals Data in the Database</p>
            @endforelse
        </table>
        @endsection