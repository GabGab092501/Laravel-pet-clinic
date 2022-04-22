@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Hoomans
        </h1>
    </div>
    <div class="py-3">
        <table class="table-auto">
            <tr class="text-black text-center">
                <th class="w-screen text-3xl">Id</th>
                <th class="w-screen text-3xl">Full Name</th>
                <th class="w-screen text-3xl">Email</th>
                <th class="w-screen text-3xl">Position</th>
                <th class="w-screen text-3xl">Images</th>

                
            </tr>
    
            @forelse ($hoomans as $hooman)
            <tr>
                <td class="text-center text-3xl">
                    <a href="{{route('hoomans.show',$hooman->id)}}">{{$hooman->id}}</a>
                </td>
                <td class="text-center text-3xl">
                    {{ $hooman->name }}
                </td>
                <td class="text-center text-3xl">
                    {{ $hooman->email }}
                </td>
                <td class="text-center text-3xl">
                    {{ $hooman->role }}
                </td>

                <td class="pl-12">
                    <img src="{{ asset('imagefolder/hoomans/'.$hooman->images)}}" alt="I am A Pic" width="75" height="75">
                  </td>
    
                  
            </tr>
            @empty
            <p>No hoomans Data in the Database</p>
            @endforelse
        </table>
    </div>

        @endsection