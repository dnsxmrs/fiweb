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
    select:focus {
      outline: none;
      border-color: #E9B303;
      box-shadow: 0 0 0 2px #E9B303;
    }
    select::placeholder {
      color: #4A5568; /* Dark gray placeholder */
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

  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Status</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Order Status Section -->
    <div class="w-[720px] mx-auto mt-10 bg-white rounded-lg shadow-lg p-6">
        <h2 class="mb-4 text-lg font-bold text-gray-700">Order Status</h2>
        <div>
      <div class="flex flex-col items-center">
        <img src="assets/Caffeinated Logo.png" alt="Coffee Icon" class="h-40 mb-10 w-35">
        <!-- Order Status -->
        <ul class="space-y-4">
          <li class="flex items-center space-x-2">
            <span class="w-4 h-4 bg-gray-300 rounded-full"></span>
            <span class="text-gray-500">Order being validated</span>
          </li>
          <li class="flex items-center space-x-2">
            <span class="w-4 h-4 rounded-full bg-[#E9B303]"></span>
            <span class="font-semibold text-black">Order being prepared</span>
          </li>
          <li class="flex items-center space-x-2">
            <span class="w-4 h-4 bg-gray-300 rounded-full"></span>
            <span class="text-gray-500">Rider on his way</span>
          </li>
          <li class="flex items-center space-x-2">
            <span class="w-4 h-4 bg-gray-300 rounded-full"></span>
            <span class="text-gray-500">Delivery on its way</span>
          </li>
          <li class="flex items-center space-x-2">
            <span class="w-4 h-4 bg-gray-300 rounded-full"></span>
            <span class="text-gray-500">Order delivered</span>
          </li>
        </ul>
      </div>
    </div>
    </div>
  
    <!-- Order Summary Section -->
    <div class="w-[720px] mx-auto mt-10 bg-white rounded-lg shadow-lg p-6">
      <h2 class="mb-4 text-lg font-bold text-gray-700">Order Summary</h2>
      <div>
        <!-- Header Row -->
        <div class="flex justify-between py-2 font-semibold text-gray-700">
          <span>Item</span>
          <span class="pl-5 ml-12">Item cost</span>
          <span class="pr-5">Qty.</span>
          <span class="text-right">Price</span>
        </div>
  
        <!-- Divider -->
        <div class="my-4 border-t"></div>
  
        <!-- Order Item -->
        <div class="flex justify-between py-2">
          <span class="text-black">Iced Americano</span>
          <span class="text-center">Php 110.00</span>
          <span class="text-center">2</span>
          <span class="text-right">Php 220.00</span>
        </div>
  
        <!-- Divider -->
        <div class="my-4 border-t"></div>
  
        <!-- Subtotal -->
        <div class="flex justify-between py-2">
          <span class="text-gray-700">Subtotal</span>
          <span class="text-right">Php 220.00</span>
        </div>
  
        <!-- Delivery Fee -->
        <div class="flex justify-between py-2">
          <span class="text-gray-700">Delivery fee</span>
          <span class="text-right">Php 50.00</span>
        </div>
  
        <!-- Divider -->
        <div class="my-4 border-t"></div>
  
        <!-- Total -->
        <div class="flex justify-between py-2 font-bold">
          <span class="text-black">Total</span>
          <span class="text-right">Php 270.00</span>
        </div>
      </div>
    </div>
    
  <!-- Payment Section -->
<div class="w-[720px] mx-auto mb-20 mt-10 bg-white rounded-lg shadow-lg p-6">
    <h2 class="mb-2 text-lg font-bold text-gray-700">Payment</h2>
    <p class="text-gray-700">Cash On Delivery</p>
    <!-- Divider -->
    <div class="my-4 border-t"></div>
    <!-- Order Details Section -->
    <h2 class="mt-6 mb-4 text-lg font-bold text-gray-700">Order Details</h2>
    <div class="space-y-6">
      <div class="flex justify-between">
        <span class="text-gray-700">Order Number</span>
        <span class="font-medium text-black">#FpTk5f</span>
      </div>
      <div class="flex justify-between">
        <span class="text-gray-700">Contact Number</span>
        <span class="font-medium text-black">09949109607</span>
      </div>
      <div class="flex justify-between">
        <span class="text-gray-700">Delivery Address</span>
        <span class="ml-12 font-medium text-right text-black">
          Block 33 Lot 8 Kasiglahan Village, Ph 1-A, San Jose, Montalban, Rizal, 1860, CALABARZON (Region IV-A), Philippines
        </span>
      </div>
    </div>
    
    <!-- Divider -->
    <div class="my-4 border-t"></div>
  
    <!-- Cancel Order Button -->
    <div class="mt-6 text-center">
        <button class="w-[175px] h-[50px] text-lg font-bold text-white bg-red-600 rounded-lg hover:bg-red-700">
            Cancel Order
        </button>
    </div>
  </div>
  
</body>
</html>