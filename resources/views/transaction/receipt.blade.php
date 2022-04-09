<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)),
    url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    </div>
    <div class="flex justify-center p-4">
        {{ Form::model($transactions,['route' => ['transaction.receipt',$transactions->id],'method'=>'PUT',
        'enctype'=>'multipart/form-data']) }}
        <div class="border-b border-gray-200 shadow">
            <table class="">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-xs text-gray-500 ">
                            Service
                        </th>
                        <th class="px-4 py-2 text-xs text-gray-500 ">
                            Animal
                        </th>
                        <th class="px-4 py-2 text-xs text-gray-500 ">
                            Cost
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="whitespace-nowrap">
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                {!! Form::select('service_id',$services2, $transactions->service_id,['class' => 'block
                                shadow-5xl
                                p-2 my-2 w-full', 'disabled' => true]) !!}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">4</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            $20
                        </td>
                        <td class="px-6 py-4">
                            $30
                        </td>
                    </tr>
                    <tr class="text-white bg-gray-800">
                        <th colspan="3"></th>
                        <td class="text-sm font-bold"><b>Total</b></td>
                        <td class="text-sm font-bold"><b>$999.0</b></td>
                    </tr>
                    <!--end tr-->

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>