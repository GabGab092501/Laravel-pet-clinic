@extends('body')

@section('contents')

<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Customer
        </h1>
    </div>
    <div>
        <div class="py-3">
            <table class="table-auto text-center">
                <tr class="text-white">
                    <th class="w-screen text-3xl">Id</th>
                    <th class="w-screen text-3xl">First Name</th>
                    <th class="w-screen text-3xl">Last Name</th>
                    <th class="w-screen text-3xl">Phone Number</th>
                    <th class="w-screen text-3xl">Customer Pic</th>
                    <th class="w-screen text-3xl">Animal</th>
                </tr>

                @forelse ($customers as $customer)

                <tr>
                    <td class="text-center text-3xl">
                        {{$customer->id}}
                    </td>
                    <td class="text-center text-3xl">
                        {{ $customer->first_name }}
                    </td>
                    <td class="text-center text-3xl">
                        {{ $customer->last_name }}
                    </td>
                    <td class="text-center text-3xl">
                        {{ $customer->phone_number }}
                    </td>
                    <td class="pl-24">
                        <img src="{{ asset('uploads/customers/'.$customer->images)}}" alt="I am A Pic" width="75"
                            height="75">
                    </td>
                    <td class=" text-center text-3xl">
                        {{ $customer->animal_name }}
                    </td>
                </tr>
                @empty
                <p>No Customer Data in the Database</p>
                @endforelse
            </table>
        </div>
        @endsection