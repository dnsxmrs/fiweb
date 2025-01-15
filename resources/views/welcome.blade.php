<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('favicon.ico') }}?v=2" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&display=swap">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Barlow', sans-serif;
        }
    </style>
</head>

<body class="h-screen bg-gradient-to-r from-white to-orange-100">

    <div class="flex items-center justify-center h-full">
        <div class="bg-white w-[1440px] h-[1024px] rounded-xl flex relative overflow-hidden">

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
                    <div class="flex items-center pt-6 mb-6">
                        <h3 class="text-2xl font-semibold text-gray-800">EXPLORE OUR MENU</h3>
                        <hr class="flex-grow w-32 ml-4 border-t-2 border-black">
                    </div>
                    <div class="flex space-x-8">
                        <button onclick="window.location.href='{{ route('order-now') }}'"
                            class="flex flex-col items-center w-40 space-y-2 text-center">
                            <img class="p-4 bg-gray-100 rounded-full w-28 h-28" src="{{ asset('assets/All-icon.png') }}"
                                alt="All">
                            <p class="text-xl">All</p>
                        </button>

                        @foreach ($categories as $category)
                            <button onclick="selectedCategory(this)" data-id="{{$category->category_id}}"
                                class="flex flex-col items-center w-40 space-y-2 text-center">
                                <img class="p-4 bg-gray-100 rounded-full w-28 h-28" src="{{ $category->image }}">
                                <p class="text-xl">{{ $category->name }}</p>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Order Now Button -->
                <button onclick="window.location.href='{{ route('order-now') }}'"
                    class="absolute px-12 py-4 text-xl font-semibold text-center text-white bg-black rounded-lg w-60 bottom-20 left-20">
                    Order Now
                </button>
            </div>

            <!-- Right Section with Background Image -->
            <div class="relative flex items-center justify-center w-1/2 overflow-hidden">
                <img src="{{ asset('assets/bg2.png') }}" alt="Background"
                    class="absolute top-0 right-0 object-cover pb-20">
                <div class="relative z-10 flex space-x-8 w-[800px] h-[750px]">
                    <!-- Coffee Image -->
                    <img src="{{ asset('assets/Coffees.png') }}" alt="Coffee Image 1"
                        class="object-cover w-full h-full">
                </div>
                <div>
                    <button
                        class="absolute z-20 flex items-center justify-center w-40 px-6 py-3 text-lg text-white bg-black rounded-full top-10 right-10">
                        <img src="{{ asset('assets/Male User.png') }}" alt="User" class="w-5 h-5 mr-2">
                        Guest
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function selectedCategory(button) {
            // Retrieve the data-id attribute from the clicked button
            const categoryId = button.dataset.id;

            // Log the category ID to the console
            console.log(`Selected Category ID: ${categoryId}`);


        }
    </script>
</body>

</html>
