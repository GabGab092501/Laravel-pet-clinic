@extends('home')

@section('contents')

@if ($message = Session::get('error'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

@if(Session::has('cart'))
<div class="">
    <div class="">
        <div>
            <ul>
                @foreach($pets as $pets)
                @foreach($services as $service)
                <li>
                    <span class="pr-6">{{ $pets['pet_name'] }}</span>
                    <span class="pr-6">{{ $service['cost'] }}</span>
                    <div class="btn-group">
                        <a class="btn btn-danger my-2 py-2"
                            href="{{ route('transaction.remove',['id'=>$service['services']['id']]) }}">Remove</a>
                    </div>
                </li>
                @endforeach
                @endforeach
            </ul>
        </div>
    </div>
    <div class="">
        <div>
            <strong>Total: {{ $totalCost }}</strong>
        </div>
    </div>
    <hr>
    <div class="">
        <div class="">
            <a href="{{route ('checkout')}}"> <button type="button" class="btn btn-success">Checkout</button><a>
        </div>
    </div>
    @else
    <div class="">
        <div class="">
            <h2 class="text-4xl text-red-700">You don't have any transac!</h2>
        </div>
    </div>
</div>
@endif
@endsection