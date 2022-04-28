<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

@if ($message = Session::get('error'))
<div class="bg-red-500 p-4 text-center">
    <strong class="text-white text-3xl pl-4 text-center">{{ $message }}</strong>
</div>
@endif

<body>
 
    <h1 class="text-start text-3xl text-black"> PET</h1>
    <section class="grid grid-flow-row justify-start gap-3 p-12 w-full">
        @foreach ($pets->chunk(1) as $servicesChunk)
        <div
            class="">
            @foreach ($servicesChunk as $pet)
            <img src="{{ asset('uploads/pets/'.$pet->images)}}" alt="I am A Pic" width="400" style="max-height: 12rem;">
            <div class="p-3">
                <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $pet->pet_name }}
                </h5>
                <p class="mb-2 text-lg font-bold">{{ $pet->type }}</p>
                <div class="grid grid-flow-col gap-2">
                    <a href=" {{ route('transaction.addPet', ['id'=>$pet->id]) }} " class="btn btn-warning"
                        role="button"><i class="fas fa-cart-plus"></i> Add pet</a>

                  
                </div>
            </div>
        </div>
        @endforeach
        @endforeach

    <h1 class="text-start text-3xl text-black pt-3"> SERVICES</h1>
        @foreach ($services->chunk(1) as $servicesChunk)
        <div
            class="">
            @foreach ($servicesChunk as $services)
            <img src="{{ asset('uploads/services/'.$services->images)}}" alt="I am A Pic" width="400"
                style="max-height: 12rem;">
            <div class="p-3">
                <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $services->services_name }}
                </h5>
                <p class="mb-2 text-lg font-bold">{{ $services->cost }}</p>
                <div class="grid grid-flow-col gap-2">
                    <a href=" {{ route('transaction.addToCart', ['id'=>$services->id]) }} " class="btn btn-warning"
                        role="button"><i class="fas fa-cart-plus"></i> Add services </a>

                    <a href=" {{route('transaction.show', ['id'=>$services->id]) }} " class="btn btn-danger"
                        role="button">View Comment</a>

                </div>
            </div>
        </div>
        @endforeach
        @endforeach
    </section>
</body>

</html>