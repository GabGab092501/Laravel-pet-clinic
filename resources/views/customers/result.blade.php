<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Search Pets</title>
</head>

<body>
    <hr>
    <h1 class="text-center text-blue-600 text-3xl font-bold pt-6">  TRANSACTION</h1>
    <div class="py-3">
        <table class="table-auto">
            <tr class="text-black text-center">
                <th class="w-screen text-4xl">Transaction Id</th>
                <th class="w-screen text-4xl">Customer</th>
                <th class="w-screen text-4xl">Animal</th>
                <th class="w-screen text-4xl">Service</th>
                <th class="w-screen text-4xl">Cost</th>
            </tr>
   
            @forelse ($customers as $customer)
            <tr>
                <td class=" text-center text-4xl">
                    {{ $customer->id }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $customer->name }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $customer->pets_name }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $customer->service_name }}
                </td>
                <td class=" text-center text-4xl">
                    {{ $customer->cost }}
                </td>
                @empty
              
                @endforelse
        </table>
    </div>
    </tr>

    
   
</body>

</html>