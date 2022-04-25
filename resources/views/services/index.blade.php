@extends('layouts.app')

@section('content')

<div class="pt-8 pb-4 px-8">
    <a href="service/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new service &rarr;
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Service Name</th>
            <th class="w-screen text-3xl">Cost</th>
            <th class="w-screen text-3xl">Service Pic</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
            <th class="w-screen text-3xl">Destroy</th>
        </tr>

        @forelse ($services as $service)
        <tr>
            @if($service->deleted_at)
            <td class="text-center text-3xl">
                <a href="#">{{$service->id}}</a>
            </td>
            @else
            <td class="text-center text-3xl">
                <a href="{{route('service.show',$service->id)}}">{{$service->id}}</a>
            </td>
            @endif
            </td>
            <td class=" text-center text-3xl">
                {{ $service->service_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $service->cost }}
            </td>
            <td class="pl-12">
                <img src="{{ asset('uploads/services/'.$service->images)}}" alt="I am A Pic" width="75" height="75">
            </td>
            @if($service->deleted_at)
            <td class=" text-center">
                <a href="#">
                    <p class="text-center text-2xl bg-green-600 p-2">
                        Update &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="service/{{ $service->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            @endif
            <td class=" text-center">
                {!! Form::open(array('route' => array('service.destroy', $service->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-2xl bg-red-600 p-2">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($service->deleted_at)
            <td>
                <a href="{{ route('service.restore', $service->id) }}">
                    <p class="text-center text-red-700 text-2xl bg-purple-500 py-2 mx-3">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-2xl bg-purple-500 py-2 mx-3">
                        Restore &rarr;
                    </p>
                </a>
            </td>
            @endif
            <td>
                <a href="{{ route('service.forceDelete', $service->id) }}">
                    <p class="text-center text-2xl bg-warning p-2 ml-2 mr-4"
                        onclick="return confirm('Do you want to delete this data permanently?')">
                        Destroy &rarr;
                    </p>
                </a>
            </td>
        </tr>
        @empty
        <p>No Service Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $services->links()}}</div>
</div>
</div>
@endsection