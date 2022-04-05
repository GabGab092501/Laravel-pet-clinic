<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="grid grid-flow-col gap-3 p-12"
    style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)), url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    @foreach ($services->chunk(1) as $serviceChunk)
    <div class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        @foreach ($serviceChunk as $service)
        <img src="{{ asset('uploads/services/'.$service->images)}}" alt="I am A Pic" width="300">
        <div class="p-3">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">{{ $service->service_name }}
            </h5>
            <p class="mb-2 text-lg font-bold">{{ $service->cost }}</p>
            <div class="grid grid-flow-col gap-1">
                <a href=" {{ route('transaction.addToCart', ['id'=>$service->id]) }} " class="btn btn-primary"
                    role="button"><i class="fas fa-cart-plus"></i> Add to Cart</a>

                <a href="#" class="btn btn-success" role="button">More Info</a>
            </div>
        </div>
    </div>
    @endforeach
    @endforeach
</body>