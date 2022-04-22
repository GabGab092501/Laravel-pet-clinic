@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Show Customer
        </h1>
    </div>
    <div class="py-3">
        <table class="table-auto text-center">
          <tr class="text-black">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Name</th>
            <th class="w-screen text-3xl">Contact Number</th>
            <th class="w-screen text-3xl">Customer Pic</th>
            <th class="w-screen text-3xl">pet</th>

          </tr>
      
          @forelse ($customers as $customer)
      
          <tr>
            <td class="text-center text-3xl">
              <a href="{{route('customer.show',$customer->id)}}">{{$customer->id}}</a>
            </td>
        
            <td class="text-center text-3xl">
              {{ $customer->name }}
            </td>
            <td class="text-center text-3xl">
              {{ $customer->contactNum }}
            </td>
            <td class="pl-12">
              <img src="{{ asset('imagefolder/customers/'.$customer->pics)}}" alt="I am A Pic" width="75" height="75">
            </td>
            <td class=" text-center text-3xl">
              {{ $customer->pets_name }}
            </td>
        
          </tr>
          @empty
          <p>No customer Data in the Database</p>
          @endforelse
        </table>
        @endsection