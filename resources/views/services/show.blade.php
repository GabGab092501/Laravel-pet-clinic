@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Services
        </h1>
    </div>
    <div class="py-3">
        <table class="table-auto">
            <tr class="text-white text-center">
                <th class="w-screen text-3xl">Id</th>
                <th class="w-screen text-3xl">Service Name</th>
                <th class="w-screen text-3xl">Cost</th>
                <th class="w-screen text-3xl">Service Pic</th>
            </tr>

            @forelse ($services as $service)
            <tr>
                <td class=" text-center text-3xl">
                    <a href="{{route('service.show',$service->id)}}">{{$service->id}}</a>
                </td>
                <td class=" text-center text-3xl">
                    {{ $service->service_name }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $service->cost }}
                </td>
                <td class="pl-48">
                    <img src="{{ asset('uploads/services/'.$service->images)}}" alt="I am A Pic" width="75" height="75">
                </td>

            </tr>
            @empty
            <p>No Service Data in the Database</p>
            @endforelse
        </table>
        @endsection