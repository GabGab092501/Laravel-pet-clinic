<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<header class="flex justify-between items-center px-10 py-6 text-white bg-gray-800">
    <div class="px-1 grid grid-flow-col font-bold text-2xl">
        <h1 class="px-1 font-bold bg-black border-black border-4 rounded-l-lg">Pet</h1>
        <h1 class="pr-1 bg-yellow-600 border-yellow-600 border-4 text-black rounded-r-lg">Clinic</h1>
    </div>
    <nav>
        <ul class="tracking-widest text-2xl">
            <button> <a href="{{ URL('home') }}">
                    <h5>Home</h5>
                </a></button>
            <button> <a href="{{ URL('animals') }}">
                    <h5>Animals</h5>
                </a></button>
            <button><a href="{{ URL('rescuer') }}">
                    <h5>Rescuers</h5>
                </a></button>
            <button><a href="{{ URL('diseaseinjury') }}">
                    <h5>Disease / Injury</h5>
                </a></button>
            <button><a href="{{ URL('adopter') }}">
                    <h5>Adopters</h5>
                </a></button>
            <button><a href={{ URL('personnel') }}>
                    <h5 class="mr-4">Personnel</h5>
                </a></button>
        </ul>
    </nav>
</header>

<body
    style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)), url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    @yield('contents')
</body>

</html>