@extends('body')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Services
        </h1>
    </div>
    @forelse ($services as $service)
    <section class="flex flex-wrap justify-center gap-3 p-12 w-full">
        <div
            class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <img src="{{asset('uploads/services/'.$service->images)}}" alt="I am A Pic" width="400"
                style="max-height: 12rem;">
            <div class="p-3">
                <h5 class="mb-2 text-2xl font-bold text-center tracking-tight">{{ $service->service_name }}
                </h5>
                ID<p class="mb-2 text-lg font-bold">{{$service->id}}</p>
                Cost<p class="mb-2 text-lg font-bold">{{ $service->cost }}</p>
            </div>
        </div>
    </section>
    {{-- <div class="py-3">
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

            </tr> --}}
            @empty
            <p>No Service Data in the Database</p>
            @endforelse
        </table>
        @endsection