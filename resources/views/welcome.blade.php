<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('favicon.ico') }}?v=2" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&display=swap" rel="stylesheet">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="h-screen bg-white">

    <div class="flex items-center justify-center h-full">
        <div class="relative flex w-auto h-auto overflow-hidden bg-white rounded-xl">

            <!-- Left Section -->
            <div class="flex flex-col w-1/2 p-20 space-y-12">

                <!-- Logo and Title -->
                <div class="flex items-center space-x-4">
                    <!-- Logo -->
                    <img src="{{ asset('assets/Caffeinated Logo.png') }}" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 9l3 3-3 3M16 9l-3 3 3 3" />
                    <div>
                        <h1 class="text-3xl font-bold">CAFFEINATED</h1>
                        <p class="text-lg text-gray-500">Food Delivery</p>
                    </div>
                </div>

                <!-- Welcome Text -->
                <div>
                    <h2 class="pt-6 text-6xl font-bold">Welcome!</h2>
                    <p class="mt-3 text-3xl italic text-gray-700">Ready to be caffeinated?</p>
                </div>

                <!-- Menu Categories -->
                <div>
                    <!-- Heading -->
                    <div class="flex items-center pt-6 mb-6">
                        <h3 class="text-2xl font-semibold text-gray-800">EXPLORE OUR MENU</h3>
                        <hr class="flex-grow w-32 ml-4 border-t-2 border-black">
                    </div>

                    <!-- Scrollable menu -->
                    <div class="overflow-x-auto">
                        <div class="flex space-x-8 w-max">
                            <!-- "All" Button -->
                            <button onclick="window.location.href='{{ route('order-now') }}'"
                                    class="flex flex-col items-center w-40 space-y-2 text-center">
                                <img class="p-4 bg-gray-100 rounded-full w-28 h-28" src="{{ asset('assets/All-icon.png') }}" alt="All">
                                <p class="text-xl">All</p>
                            </button>

                            <!-- Dynamic categories -->
                            @foreach ($categories as $category)
                                <a href="{{ route('order-now') }}#{{ $category->category_id }}" class="flex flex-col items-center w-40 space-y-2 text-center">
                                    <img class="p-4 bg-gray-100 rounded-full w-28 h-28" src="{{ $category->image }}" alt="{{ $category->name }}">
                                    <p class="text-xl">{{ $category->name }}</p>
                                </a>
                            @endforeach

                            <!-- Static Buttons -->
                            <button class="flex flex-col items-center w-40 space-y-2 text-center">
                                <img class="p-4 bg-gray-100 rounded-full w-28 h-28" src="{{ asset('assets/Coffee-icon.png') }}" alt="Coffee">
                                <p class="text-xl">Coffee</p>
                            </button>
                            <button class="flex flex-col items-center w-40 space-y-2 text-center">
                                <img class="p-4 bg-gray-100 rounded-full w-28 h-28" src="{{ asset('assets/Non-Coffee-icon.png') }}" alt="Non-Coffee">
                                <p class="text-xl">Non-Coffee</p>
                            </button>
                            <button class="flex flex-col items-center w-40 space-y-2 text-center">
                                <img class="p-4 bg-gray-100 rounded-full w-28 h-28" src="{{ asset('assets/Frappuccino-icon.png') }}" alt="Frappuccino">
                                <p class="text-xl">Frappuccino</p>
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Order Now Button -->
                <button
                    onclick="window.location.href='{{ route('order-now') }}'"
                    class="absolute px-12 py-4 text-xl font-semibold text-center text-white rounded-lg w-60 bottom-10 left-20" style="background-color:#066744;">
                    Order Now
                </button>
            </div>

            <!-- Right Section with Background Image -->
            <div class="relative flex items-center justify-center w-1/2 h-full min-h-screen overflow-hidden">
                <!-- Background Image -->
                <img src="{{ asset('assets/bg2.png') }}" alt="Background"
                    class="absolute top-0 right-0 object-cover w-full h-full">

                <!-- Content Container -->
                <div class="relative z-10 flex space-x-8 w-[800px] h-[750px]">
                    <!-- Coffee Image -->
                    <img src="{{ asset('assets/Coffees.png') }}" alt="Coffee Image 1"
                        class="object-cover w-full h-full">
                </div>

                <!-- Guest Button -->
                <div>
                    <button
                        class="absolute z-20 flex items-center justify-center w-40 px-6 py-3 text-lg text-white bg-black rounded-full top-20 right-10">
                        <img src="{{ asset('assets/Male User.png') }}" alt="User" class="w-5 h-5 mr-2">
                        Guest
                    </button>
                </div>
            </div>

        </div>
    </div>
    </div>

</body>

</html>
