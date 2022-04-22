@extends('home')

@section('contents')
<div class="pt-8 pb-4 px-8">
    <a href="service/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new service 
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-black text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Service Name</th>
            <th class="w-screen text-3xl">Cost</th>
            <th class="w-screen text-3xl">Animal Pic</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
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
            <td class="pl-10">
                <img src="{{ asset('uploads/services/'.$service->images)}}" alt="I am A Pic" width="75" height="75">
            </td>
            <td class=" text-center">
                <a href="service/{{ $service->id }}/edit" class="text-center text-2xl bg-black-600 p-2">
                    Update 
                </a>
            </td>
            <td class=" text-center">
                {!! Form::open(array('route' => array('service.destroy', $service->id),'method'=>'DELETE')) !!}
                <button type="submit" class="text-center text-2xl bg-black-600 p-2">
                    Delete 
                </button>
                {!! Form::close() !!}
            </td>
            @if($service->deleted_at)
            <td>
                <a href="{{ route('service.restore', $service->id) }}">
                    <p class="text-center text-red-700 text-2xl bg-black-500 p-2">
                        Restore 
                    </p>
                </a>
            </td>
            @else
            <td>
                <a href="#">
                    <p class="text-center text-2xl bg-black-500 p-2">
                        Restore 
                    </p>
                </a>
            </td>
            @endif
     
        </tr>
        @empty
        <p>No service Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $services->links()}}</div>
</div>
</div>
@endsection