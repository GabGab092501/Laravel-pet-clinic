<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Log In</title>
</head>

<body style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)), url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    @if ($message = Session::get('success'))
    <div class="bg-red-500 p-4">
        <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
    </div>
    @endif
    <div class="pt-32 my-5">
        <div class="text-center">
            <h1 class="text-5xl">
                Log In
            </h1>
        </div>
        <div>

            <div class="flex justify-center pt-8">
                <form action="{{ route('check') }}" method="POST">
                    @csrf
                    <div class="block">
                        <label for="email" class="text-lg">Email</label>
                        <input type="email" class="block shadow-5xl p-2 my-5 w-full" id="email" name="email"
                            placeholder="Enter your Email">

                        <label for="password" class="text-lg">Password</label>
                        <input type="password" class="block shadow-5xl p-2 my-5 w-full" id="password" name="password"
                            placeholder="Enter your password">

                    <div class="grid grid-cols-3 gap-2 w-full">
                        <a href="/personnel/create" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center">Sign up Here</a>
                        <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                            Log In
                        </button>
                        <a href="{{ route('search') }}" class="bg-blue-800 text-white font-bold p-2 mt-5 text-center">Search Pet</a>
                    </div>
                </div>
            </form>
        </div>
</body>

</html>