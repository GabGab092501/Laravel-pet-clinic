@extends('layouts.app')

@section('content')

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Animal Name</th>
            <th class="w-screen text-3xl">Customer Name</th>
            <th class="w-screen text-3xl">Service</th>
            <th class="w-screen text-3xl">Vet</th>
            <th class="w-screen text-3xl">Date</th>
            <th class="w-screen text-3xl">Status</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
        </tr>

        @forelse ($customers as $customer)
        <tr>
            <td class=" text-center text-3xl">
                {{ $customer->animal_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $customer->first_name }} {{ $customer->last_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $customer->service_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $customer->full_name }}
            </td>
            <td class=" text-center text-3xl">
                {{ $customer->date }}
            </td>
            <td class=" text-center text-3xl">
                {{ $customer->status }}
            </td>
            <td>
                <a href="transaction/{{ $customer->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            <td>
                <a href="{{ route('transaction.Delete', $customer->id) }}">
                    <p class="text-center text-2xl bg-red-600 p-2 ml-2 mr-4"
                        onclick="return confirm('Do you want to delete this transaction?')">
                        Delete &rarr;
                    </p>
                </a>
            </td>
        </tr>
        @empty
        <p>No Transaction Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $customers->links( )}}</div>
</div>
</div>
@endsection