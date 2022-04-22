@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Services
        </h1>
    </div>
    <div>
        <div class="grid grid-flow-col justify-center pt-4">
            <table class="table-auto">
                <tr class="text-black text-center">
                    <th class="w-screen text-3xl">Id</th>
                    <th class="w-screen text-3xl">Service Name</th>
                    <th class="w-screen text-3xl">Cost</th>
                    <th class="w-screen text-3xl">Animal Pic</th>
              
                </tr>
        
                @forelse ($services as $service)
                <tr>
                    <td class=" text-center text-3xl">
                       {{$service->id}}
                    </td>
                    <td class=" text-center text-3xl">
                        {{ $service->service_name }}
                    </td>
                    <td class=" text-center text-3xl">
                        {{ $service->cost }}
                    </td>
                    <td class="pl-10">
                        <img src="{{ asset('uploads/services/'.$service->images)}}" alt="I am A Pic" width="75" height="75">
                    </td>
                   
                </tr>
                @empty
                <p>No service Data in the Database</p>
                @endforelse
            </table>
            </form>
        </div>
        @endsection