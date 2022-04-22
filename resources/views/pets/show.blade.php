@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show pets
        </h1>
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
               
               
            </tr>
            @empty
            <p>No pets Data in the Database</p>
            @endforelse
        </table>
        
        @endsection