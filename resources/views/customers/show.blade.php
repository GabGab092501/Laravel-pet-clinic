@extends('body')

@section('contents')

<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Customer
        </h1>
    </div>
    @forelse ($customers as $customer)
    <section class="flex flex-wrap justify-center gap-3 p-12 w-full">
        <div
            class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
            <img src="{{ asset('uploads/customers/'.$customer->images)}}" alt="I am A Pic" width="400"
                style="max-height: 12rem;">
            <div class="p-3">
                <h5 class="mb-2 text-2xl font-bold text-center tracking-tight">{{ $customer->first_name }}
                </h5>
                ID<p class="mb-2 text-lg font-bold">{{ $customer->id }}</p>
                Last Name<p class="mb-2 text-lg font-bold">{{ $customer->last_name }}</p>
                Phone Number<p class="mb-2 text-lg font-bold">{{ $customer->phone_number }}</p>
                Pet<p class="mb-2 text-lg font-bold">{{ $customer->animal_name }}</p>
            </div>
        </div>
    </section>
    {{-- <div>
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
                </tr> --}}
                @empty
                <p>No Customer Data in the Database</p>
                @endforelse
            </table>
        </div>
        @endsection