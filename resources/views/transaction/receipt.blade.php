<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)),
    url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    @if(Session::has('cart'))
    <div class="pt-8 pb-4 px-8">
        <a href="{{ URL('dashboard') }}" class="p-3 border-none italic text-white bg-black text-lg">
            Go Back &rarr;
        </a>
    </div>
    </div>
    <h1 class="text-center text-black text-3xl pt-4">RECEIPT</h1>
    <div class="flex justify-center p-4 w-full">
        @forelse ($customers as $customer)
        <div class="grid grid-flow-row justify-center border-b border-gray-200 shadow bg-white">
            <table>
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-center px-4 py-2 text-xs text-black ">
                            Customer
                        </th>
                        <th class="text-center px-4 py-2 text-xs text-black ">
                            Animal
                        </th>
                        <th class="text-center px-4 py-2 text-xs text-black ">
                            Service
                        </th>
                        <th class="text-center px-4 py-2 text-xs text-black ">
                            Cost
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-green-400">
                    <tr class="whitespace-nowrap">
                        <td class="text-center px-6 py-4">
                            <div class="text-2xl text-black">
                                {{ $customer->first_name }}
                            </div>
                        </td>
                        <td class="text-center px-6 py-4">
                            <div class="text-2xl text-black">
                                {{ $customer->animal_name }}
                            </div>
                        </td>
                        <td class="text-center px-6 py-4 text-2xl text-black">
                            {{ $customer->service_name }}
                        </td>
                        <td class="text-center px-6 py-4 text-2xl text-black">
                            {{ $customer->cost }}
                        </td>
                    </tr>
                    @empty
                    <p class="text-center text-4xl py-8">Receipt Is Empty</p>
                    @endforelse
                </tbody>
            </table>
            <hr class="pt-2">
            <strong class="text-center pt-4 text-2xl text-black">Total: {{ $totalCost }}</strong>
        </div>
    </div>
</body>
@endif

</html>