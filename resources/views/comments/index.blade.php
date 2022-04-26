{{-- @extends('home')

@section('contents')

@if ($message = Session::get('success'))
<div class="bg-red-500 p-4">
  <strong class="text-black text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="py-3">
  <table class="table-auto text-center">
    <tr class="text-center">
      <th class="w-screen text-3xl">Id</th>
      <th class="w-screen text-3xl">Full Name</th>
      <th class="w-screen text-3xl">Email</th>
      <th class="w-screen text-3xl">Phone Number</th>
      <th class="w-screen text-3xl">Service Type</th>
      <th class="w-screen text-3xl">Review</th>
      <th class="w-screen text-3xl">Delete</th>
      <th class="w-screen text-3xl">Restore</th>
      <th class="w-screen text-3xl">Destroy</th>
    </tr>

    @forelse ($contacts as $contact)

    <tr>
      <td class="text-black text-center text-2xl">
        <a href="{{route('contact.show',$contact->id)}}">{{$contact->id}}</a>
      </td>
      <td class="text-black text-center text-2xl">
        {{ $contact->name }}
      </td>
      <td class="text-black text-center text-2xl">
        {{ $contact->email }}
      </td>
      <td class="text-black text-center text-2xl">
        {{ $contact->phone_number }}
      </td>
      <td class="text-black text-center text-2xl">
        {{ $contact->service_name }}
      </td>
      <td class="text-black text-center text-2xl">
        {{ $contact->review }}
      </td>

      <td class="text-center">
        {!! Form::open(array('route' => array('contact.destroy', $contact->id),'method'=>'DELETE')) !!}
        <button type="submit" class="text-center text-2xl bg-red-600 p-2 my-2">
          Delete &rarr;
        </button>
        {!! Form::close() !!}
      </td>

      @if($contact->deleted_at)
      <td>
        <a href="{{ route('contact.restore', $contact->id) }}">
          <p class="text-center text-red-700 text-2xl bg-purple-500 p-2 my-2">
            Restore &rarr;
          </p>
        </a>
      </td>
      @else
      <td>
        <a href="#">
          <p class="text-center text-2xl bg-purple-500 p-2 my-2">
            Restore &rarr;
          </p>
        </a>
      </td>
      @endif

      <td>
        <a href="{{ route('contact.forceDelete', $contact->id) }}">
          <p class="text-center text-2xl bg-warning p-2 ml-3 mr-4 my-2"
            onclick="return confirm('Do you want to delete this data permanently?')">
            Destroy &rarr;
          </p>
        </a>
      </td>
    </tr>
    @empty
    <p>No Contact Data in the Database</p>
    @endforelse
  </table>
  <div class="pt-6 px-4">{{ $contacts->links( )}}</div>
</div>
</div>
@endsection --}}