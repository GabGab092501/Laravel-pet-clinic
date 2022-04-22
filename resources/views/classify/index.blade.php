@extends('home')

@section('contents')

<div class="pt-8 pb-4 px-8">
  <a href="classify/create" class="p-3 border-none italic text-white bg-black text-lg">
    Add a new classify
  </a>
</div>

<div class="py-3">
  <table class="table-auto text-center">
    <tr class="text-black">
      <th class="w-screen text-3xl">Id</th>
      <th class="w-screen text-3xl">Classify</th>
      <th class="w-screen text-3xl">Update</th>
      <th class="w-screen text-3xl">Delete</th>
      <th class="w-screen text-3xl">Restore</th>
    </tr>

    @forelse ($classify as $classify)

    <tr>
      <td class="text-center text-3xl">
        {{ $classify->id }}
      </td>
      <td class="text-center text-3xl">
        {{ $classify->classify }}
      </td>
  
     
      <td class=" text-center">
        <a href="classify/{{ $classify->id }}/edit" class="text-center text-2xl -600 p-2">
          Update
        </a>
      </td>
      <td class=" text-center">
        {!! Form::open(array('route' => array('classify.destroy', $classify->id),'method'=>'DELETE')) !!}
        <button type="submit" class="text-center text-2xl bg-black-600 p-2 my-2">
          Delete
        </button>
        {!! Form::close() !!}
      </td>

      @if($classify->deleted_at)
      <td>
        <a href="{{ route('classify.restore', $classify->id) }}">
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
    <p>No classify Data in the Database</p>
    @endforelse
  </table>



</div>
</div>
@endsection