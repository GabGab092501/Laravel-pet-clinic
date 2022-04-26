<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="pt-8 pb-4 px-8">
        <a href="{{url()->previous()}}" class="p-3 border-none italic text-white bg-black text-lg">
            Go Back &rarr;
        </a>
    </div>
    </div>
    <h1 class="">RECEIPT</h1>
    <div class="">
        @forelse ($customers as $customer)
        <div class="">
            <table>
                <thead class="bg-gray-50">
                    <tr>
                        <th class=" ">
                            Customer
                        </th>
                        <th class=" ">
                            Animal
                        </th>
                        <th class=" ">
                            Service
                        </th>
                        <th class=" ">
                            Cost
                        </th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr class="">
                        <td class="">
                            <div class="">
                                {{ $customer->name }}
                            </div>
                        </td>
                        <td class="">
                            <div class="">
                                {{ $customer->pets_name }}
                            </div>
                        </td>
                        <td class="">
                            {{ $customer->service_name }}
                        </td>
                        <td class=" ">
                            {{ $customer->cost }}
                        </td>
                    </tr>
                    @empty
                    <p class="">Receipt Is Empty</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>