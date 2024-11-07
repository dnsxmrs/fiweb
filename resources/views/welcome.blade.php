<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Caffeinated Food Delivery</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&display=swap" rel="stylesheet">
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
          <img src="{{ asset('assets/Caffeinated Logo.png') }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3M16 9l-3 3 3 3" />
          <div>
            <h1 class="text-3xl font-bold">CAFFEINATED</h1>
            <p class="text-lg text-gray-500">Food Delivery</p>
          </div>
        </div>

        <!-- Welcome Text -->
        <div>
          <h2 class="text-6xl font-bold">Welcome!</h2>
          <p class="mt-3 text-3xl italic text-gray-700">Ready to be caffeinated?</p>
        </div>

        <!-- Menu Categories -->
        <div>
          <h3 class="mb-6 text-2xl font-semibold text-gray-800">EXPLORE OUR MENU</h3>
          <div class="flex space-x-8">
            <!-- Menu Buttons -->
            <button class="flex flex-col items-center w-20 space-y-2 text-center">
              <img class="w-16 h-16 p-3 bg-gray-100 rounded-full" src="{{ asset('assets/Food Bar.png') }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3M16 9l-3 3 3 3" />
              <p class="text-lg">All</p>
            </button>
            <button class="flex flex-col items-center w-20 space-y-2 text-center">
              <img class="w-16 h-16 p-3 bg-gray-100 rounded-full" src="{{ asset('assets/Coffee Beans.png') }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3M16 9l-3 3 3 3" />
              <p class="text-lg">Coffee</p>
            </button>
            <button class="flex flex-col items-center w-24 space-y-2 text-center">
              <img class="w-16 h-16 p-3 bg-gray-100 rounded-full" src="{{ asset('assets/Iced Coffee.png') }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3M16 9l-3 3 3 3" />
              <p class="text-lg">Non-Coffee</p>
            </button>
            <button class="flex flex-col items-center w-20 space-y-2 text-center">
              <img class="w-16 h-16 p-3 bg-gray-100 rounded-full" src="{{ asset('assets/Rice Bowl.png') }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3M16 9l-3 3 3 3" />
              <p class="text-lg">Meal</p>
            </button>
            <button class="flex flex-col items-center w-20 space-y-2 text-center">
              <img class="w-16 h-16 p-3 bg-gray-100 rounded-full" src="{{ asset('assets/French Fries.png') }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3M16 9l-3 3 3 3" />
              <p class="text-lg">Snack</p>
            </button>
            <button class="flex flex-col items-center w-20 space-y-2 text-center">
              <img class="w-16 h-16 p-3 bg-gray-100 rounded-full" src="{{ asset('assets/Cupcake.png') }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3M16 9l-3 3 3 3" />
              <p class="text-lg">Dessert</p>
            </button>
          </div>
        </div>

        <!-- Order Now Button -->
        <button class="w-48 px-12 py-4 text-xl font-semibold text-center text-white bg-black rounded-lg">Order Now</button>
      </div>

      <!-- Right Section with Background Image -->
        <div class="relative flex items-center justify-center w-1/2 overflow-hidden">
            <img src="{{ asset('assets/bg2.png') }}" alt="Background" class="absolute top-0 right-0 object-cover pb-20">
            <div class="relative z-10 flex space-x-8">
                <!-- coffee images -->
                <img src="{{ asset('assets/coffee1.png') }}" alt="Coffee Image 1" class="object-cover w-48 h-80">
                <img src="{{ asset('assets/coffee2.png') }}" alt="Coffee Image 2" class="object-cover w-56 h-96">
                <img src="{{ asset('assets/coffee3.png') }}" alt="Coffee Image 3" class="object-cover w-44 h-72">
              </div>
            </div>
        </div>
      
      <!-- Guest Button -->
      <button class="absolute px-6 py-3 text-lg text-white bg-black rounded-lg top-10 right-10">Guest</button>

    </div>
  </div>

</body>
</html>
