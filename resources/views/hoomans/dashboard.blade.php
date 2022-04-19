@extends('home')

@section('contents')
<h1 class="text-center text-5xl pb-8 pt-6 font-bold text-black-600">Welcome,  {{
  Auth::user()->name }}</h1>

<div class="py-3">
  <table class="table-auto">
    <tr class="text-center">
      <th class="w-screen text-4xl">Id</th>
      <th class="w-screen text-4xl">Position</th>
      <th class="w-screen text-4xl">Email</th>
    </tr>

    <tr>
      <td class=" text-center text-4xl text-black">
        {{ Auth::id() }}
      </td>
      <td class=" text-center text-4xl text-black">
        {{ Auth::user()->role }}
      </td>
      <td class=" text-center text-4xl text-black">
        {{ Auth::user()->email }}
      </td>
    </tr>
  </table>
</div>
</div>


@endsection