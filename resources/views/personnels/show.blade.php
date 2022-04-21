@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Personnel
        </h1>
    </div>
    <div class="py-3">
        <table class="table-auto">
            <tr class="text-white text-center">
                <th class="w-screen text-3xl">Id</th>
                <th class="w-screen text-3xl">Full Name</th>
                <th class="w-screen text-3xl">Email</th>
                <th class="w-screen text-3xl">Position</th>
                <th class="w-screen text-3xl">Personnel Pic</th>

            </tr>

            @forelse ($personnels as $personnel)
            <tr>
                <td class="text-center text-2xl">
                    <a href="{{route('personnel.show',$personnel->id)}}">{{$personnel->id}}</a>
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
                <td class="pl-32">
                    <img src="{{ asset('uploads/personnels/'.$personnel->images)}}" alt="I am A Pic" width="75"
                        height="75">
                </td>
            </tr>
            @empty
            <p>No Personnel Data in the Database</p>
            @endforelse
        </table>
        @endsection