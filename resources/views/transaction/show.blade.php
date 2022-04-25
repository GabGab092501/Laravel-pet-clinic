@extends('body')

@section('contents')

<a href="{{ route('review') }}" class=" mt-4 ml-4 btn btn-danger text-white font-bold">Add Comment</a>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Full Name</th>
            <th class="w-screen text-3xl">Email</th>
            <th class="w-screen text-3xl">Phone Number</th>
            <th class="w-screen text-3xl">Review</th>
            <th class="w-screen text-3xl">Service</th>
        </tr>

        @forelse ($services as $service)
        <tr>
            <td class=" text-center text-3xl">
                {{ $service->id }}
            </td>
            <td class=" text-center text-3xl">
                {{ $service->name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $service->email }}
            </td>
            <td class=" text-center text-3xl">
                {{ $service->phone_number }}
            </td>
            <td class=" text-center text-3xl">
                {{ $service->review }}
            </td>
            <td class=" text-center text-3xl">
                {{ $service->service_name }}
            </td>
        </tr>
        @empty
        <p>No One Commented In This Service.</p>
        @endforelse
    </table>
</div>
</div>
@endsection