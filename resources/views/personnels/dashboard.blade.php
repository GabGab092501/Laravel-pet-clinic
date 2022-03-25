@extends('layouts.app')

@section('content')
  <audio autoplay="" loop="" src="Joe Lamont  Victims Of Love.mp3"></audio>
<h1 class="text-center text-5xl pb-8 pt-6 text-blue-600">Welcome To ACME Pet Clinic, {{ Auth::user()->full_name }}</h1>
<hr>
<div class="py-3">
  <table class="table-auto">
    <tr class="text-center">
      <th class="w-screen text-4xl">Id</th>
      <th class="w-screen text-4xl">Position</th>
      <th class="w-screen text-4xl">Email</th>
    </tr>

    <tr>
      <td class=" text-center text-4xl text-white">
        {{ Auth::id() }}
      </td>
      <td class=" text-center text-4xl text-white">
        {{ Auth::user()->role }}
      </td>
      <td class=" text-center text-4xl text-white">
        {{ Auth::user()->email }}
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