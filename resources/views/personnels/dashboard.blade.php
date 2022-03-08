@extends('body')

@section('contents')

<h1 class="text-center text-5xl pb-8 pt-6 text-blue-600">Welcome To ACME Pet Clinic, {{ $personnel->full_name }}</h1>
<hr>
<div class="py-3">
  <table class="table-auto">
    <tr class="text-white">
      <th class="w-screen text-3xl">Id</th>
      <th class="w-screen text-3xl">Position</th>
      <th class="w-screen text-3xl">Email</th>
      <th class="w-screen text-3xl">Personnel Pic</th>
      <th class="w-screen text-3xl">Action</th>
    </tr>

    <tr>
      <td class=" text-center text-3xl">
        {{ $personnel->id }}
      </td>
      <td class=" text-center text-3xl">
        {{ $personnel->role }}
      </td>
      <td class=" text-center text-3xl">
        {{ $personnel->email }}
      </td>
      <td class="pl-24">
        <img src="{{ asset('uploads/personnels/'.$personnel->images)}}" alt="I am A Pic" width="75" height="75">
      </td>
      <td class=" text-center text-3xl ">
        <a href="logout" class="bg-red-600 py-2 px-6">Logout &rarr;</a>
      </td>
    </tr>
  </table>
</div>
</div>
<hr>
<h1 class="text-center text-5xl pt-20 px-4 text-green-600">Our mission is to provide the highest quality animal care to
  your pet and improve his or her quality of life through the preservation, enhancement, and restoration of your pets
  health.</h1>

@endsection