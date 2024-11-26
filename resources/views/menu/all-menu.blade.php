<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu UI</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600&display=swap');
    body {
      font-family: 'Barlow', sans-serif;
    }
  </style>
</head>
<body class="bg-gray-100">
  <!-- Navbar -->
  <header class="sticky top-0 z-10 bg-white" style="height: 80px; box-shadow: 0 4px 6px rgba(139, 69, 19, 0.3);">
    <div class="container flex items-center justify-between h-full px-4 mx-auto">
      <!-- Logo and Text -->
      <div class="flex items-center space-x-3">
        <img src="assets/Caffeinated Logo.png" alt="Caffeinated Logo" class="w-12 h-12">
        <div class="flex items-center">
          <div>
            <span class="text-2xl font-bold leading-none text-black">CAFFEINATED</span>
            <p class="text-sm font-medium text-gray-500">Food Delivery</p>
          </div>
  
          <!-- Navigation Links -->
          <nav class="hidden ml-8 space-x-8 md:flex">
            <a href="#" class="text-lg font-bold text-gray-700 hover:text-[#E9B303]">Home</a>
            <a href="#" class="text-lg font-bold text-gray-700 hover:text-[#E9B303]">Menu</a>
            <a href="#" class="text-lg font-bold text-gray-700 hover:text-[#E9B303]">Orders</a>
          </nav>
        </div>
      </div>
      <!-- Search Bar, Basket Icon, and Buttons -->
      <div class="flex items-center space-x-2">
        <!-- Search Bar -->
        <div class="relative">
          <input
            id="searchInput"
            type="text"
            placeholder="Search..."
            class="w-64 h-10 px-4 text-sm border rounded-full focus:outline-none focus:ring-2 focus:ring-[#E9B303] border-gray-300"
          />
          <button id="searchButton" class="absolute top-0 right-2 h-full text-gray-500 hover:text-[#E9B303]">
            <img src="assets/Search.png" alt="Search Icon" class="w-5 h-5">
          </button>
        </div>
  
        <script>
          document.getElementById('searchButton').addEventListener('click', function() {
            document.getElementById('searchInput').focus();
          });
        </script>
  
        <!-- Basket Icon -->
        <button class="relative flex items-center">
          <img src="assets/order-bag.png" alt="Order Bag" class="w-12 h-12">
          <span class="absolute top-0 right-0 flex items-center justify-center w-4 h-5 text-xs text-white bg-red-500 rounded-full">3</span>
        </button>
  
        <!-- Guest Button -->
        <button class="flex items-center justify-center w-40 h-10 px-6 py-3 text-lg text-white bg-black rounded-full hover:bg-brown-600">
          <img src="{{ asset('assets/Male User.png') }}" alt="User" class="w-5 h-5 mr-2">Guest
        </button>
  
        <!-- My Account Button -->
        <button class="px-4 py-2 text-sm text-white rounded-md bg-brown-500 hover:bg-brown-600">
          My account
        </button>
      </div>
    </div>
  </header>

    <!-- Menu header -->
    <div class="relative sticky z-10 h-40 bg-center bg-cover top-20" style="background-image: url('assets/coffee-shop-bg.png'); margin-bottom: 0;">
        <div class="absolute inset-0 flex flex-col items-center justify-center bg-black bg-opacity-30">
        <h1 class="text-5xl font-bold text-white">MENU</h1>
        <p class="mt-2 text-2xl font-light text-white">What are you craving today?</p>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="sticky z-10 bg-white shadow-md top-60">
        <div class="flex justify-center py-4 space-x-4">
          <button class="px-4 py-2 text-lg font-medium text-black border-b-2 border-black hover:text-black-800">All Menu</button>
          <button class="px-4 py-2 font-medium text-black font-lg hover:text-black-800">Coffee</button>
          <button class="px-4 py-2 font-medium text-black font-lg hover:text-black-800">Non-coffee</button>
          <button class="px-4 py-2 font-medium text-black font-lg hover:text-black-800">Frappuccino</button>
          <button class="px-4 py-2 font-medium text-black font-lg hover:text-black-800">Snack</button>
          <button class="px-4 py-2 font-medium text-black font-lg hover:text-black-800">Dessert</button>
        </div>
      </div>

    <!-- Menu Section -->
    <main class="container px-4 py-8 mx-auto">
      
      <!-- Iced Espresso Section -->
    <section class="mb-12">
        <h3 class="mb-4 text-2xl font-semibold text-brown-700">Iced Espresso</h3>
        <div class="grid grid-cols-1 gap-x-5 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <!-- Product Cards -->
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <!-- Product Image -->
            <div class="p-4">
            <img src="assets/Iced_Americano.png" alt="Americano" class="object-cover w-full rounded-lg h-44">
            </div>
            <!-- Product Name -->
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Americano</h4>
            </div>
            <!-- Add to Bag Button -->
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Sweetened Americano.png" alt="Sweetened Americano" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Sweetened Americano</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Cafe Latte.png" alt="Cafe Latte" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Cafe Latte</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Caramel Macchiato.png" alt="Caramel Macchiato" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Caramel Macchiato</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/White Americano.png" alt="White Americano" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">White Americano</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Spanish Latte.png" alt="Spanish Latte" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Spanish Latte</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Mocha.png" alt="Mocha" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Mocha</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Cafe Hazelnut.png" alt="Cafe Hazelnut" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Cafe Hazelnut</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Ube Espresso Fusion.png" alt="Ube Espresso Fusion" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Ube Espresso Fusion</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        </div>
    </section>
  
    <!-- Hot Espresso Section -->
    <section class="mb-12">
        <h3 class="mb-4 text-2xl font-semibold text-brown-700">Hot Espresso</h3>
        <div class="grid grid-cols-1 gap-x-5 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <!-- Product Cards -->
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <!-- Product Image -->
            <div class="p-4">
            <img src="assets/Hot-Americano.png" alt="Americano" class="object-cover w-full rounded-lg h-44">
            </div>
            <!-- Product Name -->
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Americano</h4>
            </div>
            <!-- Add to Bag Button -->
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Hot-Cafe Latte.png" alt="Cafe Latte" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Cafe Latte</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Hot-Spanish Latte.png" alt="Spanish Latte" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Spanish Latte</h4>
            </div> 
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Hot-Mocha.png" alt="Mocha" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Mocha</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Hot-Caramel Macchiato.png" alt="Caramel Macchiato" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Caramel Macchiato</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        </div>
    </section>

    <!-- Iced Non-Espresso Section -->
    <section class="mb-12">
        <h3 class="mb-4 text-2xl font-semibold text-brown-700">Iced Non-Espresso</h3>
        <div class="grid grid-cols-1 gap-x-5 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <!-- Product Cards -->
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <!-- Product Image -->
            <div class="p-4">
            <img src="assets/Iced-Choco.png" alt="Choco" class="object-cover w-full rounded-lg h-44">
            </div>
            <!-- Product Name -->
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Choco</h4>
            </div>
            <!-- Add to Bag Button -->
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Iced-Strawberry Milk.png" alt="Strawberry Milk" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Strawberry Milk</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Iced-Matcha Latte.png" alt="Matcha Latte" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Matcha Latte</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        </div>
    </section>
        
        <!-- Hot Non-Espresso Section -->
    <section class="mb-12">
        <h3 class="mb-4 text-2xl font-semibold text-brown-700">Hot Non-Espresso</h3>
        <div class="grid grid-cols-1 gap-x-5 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <!-- Product Cards -->
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <!-- Product Image -->
            <div class="p-4">
            <img src="assets/Hot-Choco.png" alt="Choco" class="object-cover w-full rounded-lg h-44">
            </div>
            <!-- Product Name -->
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Choco</h4>
            </div>
            <!-- Add to Bag Button -->
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
      </div>
    </section>

    <!-- Frappuccino Espresso Section -->
    <section class="mb-12">
        <h3 class="mb-4 text-2xl font-semibold text-brown-700">Frappuccino Espresso</h3>
        <div class="grid grid-cols-1 gap-x-5 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <!-- Product Cards -->
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <!-- Product Image -->
            <div class="p-4">
            <img src="assets/Frappuccino-Java Chip.png" alt="Java Chip" class="object-cover w-full rounded-lg h-44">
            </div>
            <!-- Product Name -->
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Java Chip</h4>
            </div>
            <!-- Add to Bag Button -->
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Frappuccino-Caramel.png" alt="Caramel" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Caramel</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Frappuccino-Mocha Hazelnut.png" alt="Mocha Hazelnut" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Mocha Hazelnut</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        </div>
    </section>

    <!-- Frappuccino Non-Espresso Section -->
    <section class="mb-12">
        <h3 class="mb-4 text-2xl font-semibold text-brown-700">Frappuccino Non-Espresso</h3>
        <div class="grid grid-cols-1 gap-x-5 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <!-- Product Cards -->
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <!-- Product Image -->
            <div class="p-4">
            <img src="assets/Frappuccino-Choco Hazelnut.png" alt="Choco Hazelnut" class="object-cover w-full rounded-lg h-44">
            </div>
            <!-- Product Name -->
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Choco Hazelnut</h4>
            </div>
            <!-- Add to Bag Button -->
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Frappuccino-Strawberry Delight.png" alt="Strawberry Delight" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Strawberry Delight</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Frappuccino-Choc Chip.png" alt="Choc Chip" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Choc Chip</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Frappuccino-Matcha.png" alt="Matcha" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Matcha</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        </div>
    </section>

    <!-- Snack Section -->
    <section class="mb-12">
        <h3 class="mb-4 text-2xl font-semibold text-brown-700">Snack</h3>
        <div class="grid grid-cols-1 gap-x-5 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <!-- Product Cards -->
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <!-- Product Image -->
            <div class="p-4">
            <img src="assets/Fries.png" alt="Fries" class="object-cover w-full rounded-lg h-44">
            </div>
            <!-- Product Name -->
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Fries</h4>
            </div>
            <!-- Add to Bag Button -->
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Big Siomai.png" alt="Big Siomai" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Big Siomai</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Siomai Rice.png" alt="Siomai Rice" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Siomai Rice</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        </div>
    </section>

    <!-- Dessert Section -->
    <section class="mb-12">
        <h3 class="mb-4 text-2xl font-semibold text-brown-700">Dessert</h3>
        <div class="grid grid-cols-1 gap-x-5 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
        <!-- Product Cards -->
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <!-- Product Image -->
            <div class="p-4">
            <img src="assets/Chocolate Chip Cookie.png" alt="Chocolate Chip Cookie" class="object-cover w-full rounded-lg h-44">
            </div>
            <!-- Product Name -->
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Chocolate Chip Cookie</h4>
            </div>
            <!-- Add to Bag Button -->
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Compfire S’mores Cookie.png" alt="Compfire S’mores Cookie" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Compfire S’mores Cookie</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Fudgy Brownie.png" alt="Fudgy Brownie" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Fudgy Brownie</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        <div class="mx-auto bg-white rounded-lg shadow-md w-70">
            <div class="p-4">
            <img src="assets/Red Velvet Slice.png" alt="Red Velvet Slice" class="object-cover w-full rounded-lg h-44">
            </div>
            <div class="text-center">
            <h4 class="mb-2 text-lg font-bold text-gray-800">Red Velvet Slice</h4>
            </div>
            <button 
            id="addToBagBtn"
            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition">
            Add to bag
        </button>
        </div>
        </div>
    </section>
  </main>
  
  <!-- Snacks/Dessert Modal -->
<div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-[#E9B303] w-[455px] h-[590px] rounded-lg shadow-lg p-6">
        <div class="text-center">
            <!-- Header -->
            <h2 class="mb-4 text-2xl font-bold text-white">Customize your order</h2>

            <!-- Product Image -->
            <img src="assets/Iced_Americano.png" alt="Americano" class="mx-auto w-[350px] h-[200px] rounded-lg mb-4">

            <!-- Product Title -->
            <h3 class="mb-2 text-2xl font-semibold text-white">Fries</h3>
            <p class="mb-4 text-lg text-white">Snack</p>

            <!-- Total Price -->
            <p class="mb-4 text-xl font-semibold text-white p">Php 75.00</p>

            <!-- Quantity Selector -->
            <div class="flex items-center justify-center pb-5 mb-6">
                <button class="px-4 py-2 text-xl font-bold text-white bg-black rounded-full">-</button>
                <span class="mx-6 text-xl text-white">1</span>
                <button class="px-4 py-2 text-xl font-bold text-white bg-black rounded-full">+</button>
            </div>

            <!-- Add to Bag Button -->
            <button id="closeModalBtn" class="w-full py-3 text-sm font-semibold text-white bg-black rounded-full">
                Add to my bag
            </button>
        </div>
    </div>
</div>

<script>
// JavaScript to open/close modal
const modal = document.getElementById("modal");
const addToBagBtn = document.getElementById("addToBagBtn"); // Trigger button (replace/add multiple IDs if needed)
const closeModalBtn = document.getElementById("closeModalBtn");

// Open Modal
addToBagBtn?.addEventListener("click", () => {
    modal.classList.remove("hidden");
});

// Close Modal
closeModalBtn?.addEventListener("click", () => {
    modal.classList.add("hidden");
});

// Close modal on clicking outside the content
modal.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.classList.add("hidden");
    }
});
</script>

</body>
</html>
