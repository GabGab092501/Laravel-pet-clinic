@extends('home')

@section('contents')

<div class="pt-8 pb-4 px-8">
  <a href="diseases/create" class="p-3 border-none italic text-white bg-black text-lg">
    Add a new diseases
  </a>
</div>

<div class="py-3">
  <table class="table-auto text-center">
    <tr class="text-black">
      <th class="w-screen text-3xl">Id</th>
      <th class="w-screen text-3xl">diseases</th>
      <th class="w-screen text-3xl">Update</th>
      <th class="w-screen text-3xl">Delete</th>
      <th class="w-screen text-3xl">Restore</th>
    </tr>

    @forelse ($diseases as $diseases)

    <tr>
      <td class="text-center text-3xl">
        {{ $diseases->id }}
      </td>
      <td class="text-center text-3xl">
        {{ $diseases->diseases }}
      </td>
  
     
      <td class=" text-center">
        <a href="diseases/{{ $diseases->id }}/edit" class="text-center text-2xl -600 p-2">
          Update
        </a>
      </td>
      <td class=" text-center">
        {!! Form::open(array('route' => array('diseases.destroy', $diseases->id),'method'=>'DELETE')) !!}
        <button type="submit" class="text-center text-2xl bg-black-600 p-2 my-2">
          Delete
        </button>
        {!! Form::close() !!}
      </td>

      @if($diseases->deleted_at)
      <td>
        <a href="{{ route('diseases.restore', $diseases->id) }}">
          <p class="text-center text-red-700 text-2xl bg-black-600 p-2 my-2">
            Restore
          </p>
        </a>
      </td>
      @else
      <td>
        <a href="#">
          <p class="text-center text-2xl bg-black-500 p-2 my-2">
            Restore
          </p>
        </a>
      </td>
      @endif

      
    </tr>
    @empty
    <p>No diseases Data in the Database</p>
    @endforelse
  </table>



</div>
</div>
@endsection