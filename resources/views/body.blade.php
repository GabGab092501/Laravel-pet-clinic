<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<header class="flex justify-between items-center px-10 py-6 text-white bg-gray-800">
    <a href="{{ URL('data') }}">
        <div class="px-1 grid grid-flow-col font-bold text-2xl">
            <h1 class="px-1 font-bold bg-black border-black border-4 rounded-l-lg">Pets</h1>
            <h1 class="pr-1 bg-yellow-600 border-yellow-600 border-4 text-black rounded-r-lg">Clinic</h1>
        </div>
    </a>
    <nav>
        <ul class="tracking-widest text-2xl">
            <button> <a href="{{ URL('dashboard') }}">
                    <h5>Home</h5>
                </a></button>
            <button> <a href="{{ URL('animals') }}">
                    <h5>Animal</h5>
                </a></button>
            <button><a href="{{ URL('customer') }}">
                    <h5>Customer</h5>
                </a></button>
            <button><a href="{{ URL('service') }}">
                    <h5>Services</h5>
                </a></button>
            <button><a href="{{ URL('consultation') }}">
                    <h5>Consultations</h5>
                </a></button>
            <button><a href="{{ URL('contact') }}">
                    <h5 class="mr-4">Feedback</h5>
                </a></button>
            <button><a href={{ URL('personnel') }}>
                    <h5 class="mr-4">Personnel</h5>
                </a></button>
            <a href="{{ URL('detail') }}" class="w3-bar-item w3-button w3-mobile">
                <h5>Test</h5>
            </a>

            <li class="nav-item">
                <a href="{{ route('transaction.shoppingCart') }}">
                    <i class="fa fa-paw" aria-hidden="true"></i> Pet Transaction
                    <span class="text-xs text-white">{{ Session::has('cart') ? Session::get('cart')->totalCost :
                        '' }}</span>
                </a>
            </li>
        </ul>
    </nav>
</header>

<body
    style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)), url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover; overflow-x: hidden;">
    @include('sweetalert::alert')
    @yield('contents')
</body>

</html>