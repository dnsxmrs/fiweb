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

    <!-- Menu Section -->
    <main class="container px-4 py-8 mx-auto">
        
      <div class="container p-6 mx-auto">
        <!-- Main Layout -->
<main class="container px-4 py-8 mx-auto">
  <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
    
    <!-- Left Section: Contact and Address Details -->
    <div class="col-span-2 space-y-4">
      
      <!-- Contact Details -->
      <div class="p-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-lg font-bold">Contact Details</h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          <div>
            <label for="firstName" class="block text-sm font-medium text-gray-700">First Name</label>
            <input type="text" id="firstName" value="Miyuki Mharie" placeholder="Enter first name" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
          </div>
          <div>
            <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input type="text" id="lastName" value="Parocha" placeholder="Enter last name" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
          </div>
        </div>
        <div class="mt-4">
          <label for="contactNumber" class="block text-sm font-medium text-gray-700">Contact Number<span class="text-red-500"> *</span>
          </label>
          <input type="text" id="contactNumber" value="09949109607" placeholder="Enter contact number" class="mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
        </div>
      </div>

      <!-- Address Details -->
      <div class="p-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-lg font-bold">Deliver to</h2>
        <div>
          <label for="region" class="block text-sm font-medium text-gray-700">Region/City/District<span class="text-red-500"> *</span>
          </label>
          <input type="text" id="region" value="Rizal/Rodriguez (Montalban)/San Jose" placeholder="Enter region, city, or district" class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
        </div>
        <div class="mt-4">
          <label for="street" class="block text-sm font-medium text-gray-700">Street/Building Name<span class="text-red-500"> *</span>
          </label>
          <input type="text" id="street" value="Strawberry Street" placeholder="Enter street or building name" class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
        </div>
        <div class="mt-4">
          <label for="unit" class="block text-sm font-medium text-gray-700">Unit/Floor<span class="text-red-500"> *</span>
          </label>
          <input type="text" id="unit" value="Block 33 Lot 8 Phase 1A" placeholder="Enter unit or floor" class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
        </div>
        <div class="mt-4">
          <span class="block text-sm font-medium text-gray-700">Select address type<span class="text-red-500"> *</span>
          <div class="flex items-center mt-2 space-x-4">
            <label class="flex items-center space-x-2">
              <input type="radio" name="addressType" value="Residential" checked class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
              <span>Residential</span>
            </label>
            <label class="flex items-center space-x-2">
              <input type="radio" name="addressType" value="Office" class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
              <span>Office</span>
            </label>
          </div>
        </div>
        <div class="mt-6">
          <button class="px-6 py-2 font-bold text-white bg-black rounded-md hover:bg-gray-800">Update address</button>
        </div>
      </div>

      <!-- Delivery Time Section -->
      <div class="p-6 mt-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-lg font-bold">Delivery time</h2>
        <div>
          <label for="deliveryTime" class="block text-sm font-medium text-gray-700">Choose delivery time<span class="text-red-500"> *</span>
          </label>
          <div class="relative mt-2">
            <select id="deliveryTime" class="w-full px-4 py-3 bg-gray-100 text-black border border-gray-300 rounded-md appearance-none focus:ring-[#E9B303] focus:border-[#E9B303]">
              <option value="ASAP" selected>ASAP</option>
              <option value="9AM">9:00 AM</option>
              <option value="10AM">10:00 AM</option>
              <option value="11AM">11:00 AM</option>
            </select>
            <!-- Dropdown Icon -->
            <div class="absolute inset-y-0 flex items-center pointer-events-none right-3">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </div>
        </div>
      </div>

      <!-- Discounts Section -->
      <div class="p-6 mt-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-lg font-bold">Discounts</h2>
        <div>
          <label for="discount" class="block text-sm font-medium text-gray-700">Select Senior or PWD Discount</label>
          <div class="relative mt-2">
            <select id="discount" class="w-full px-4 py-3 bg-gray-100 text-black border border-gray-300 rounded-md appearance-none focus:ring-[#E9B303] focus:border-[#E9B303]">
              <option value="PWD">PWD Discount</option>
              <option value="Senior Citizen">Senior Citizen Discount</option>
            </select>
            <!-- Dropdown Icon -->
            <div class="absolute inset-y-0 flex items-center pointer-events-none right-3">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>
          </div>
        </div>
        <div class="mt-4">
          <button class="px-6 py-2 font-bold text-white bg-black rounded-md hover:bg-gray-800">Register SC/PWD Discount</button>
        </div>
      </div>

      <!-- Payment Section -->
      <div class="p-6 mt-6 bg-white rounded-lg shadow-md">
        <h2 class="mb-4 text-lg font-bold">Payment</h2>
        <div>
          <p class="text-sm font-medium text-gray-700">Select your preferred payment method<span class="text-red-500"> *</span>
          </label></p>
          <div class="mt-4 space-y-4">
            <!-- Cash on Delivery -->
            <label class="flex items-center justify-between p-4 bg-white border border-black rounded-md shadow-md cursor-pointer">
              <span class="flex items-center space-x-2">
                <input type="radio" name="paymentMethod" value="cashOnDelivery" class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
                <span>Cash On Delivery</span>
              </span>
            </label>

            <!-- Paymaya -->
            <label class="flex items-center justify-between p-4 bg-white border border-black rounded-md shadow-md cursor-pointer">
              <span class="flex items-center space-x-2">
                <input type="radio" name="paymentMethod" value="paymaya" class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
                <span>Paymaya</span>
              </span>
              <img src="assets/paymaya.png" alt="Paymaya" class="w-10 h-15">
            </label>

            <!-- Debit/Credit Card -->
            <label class="flex items-center justify-between p-4 bg-white border border-black rounded-md shadow-md cursor-pointer">
              <span class="flex items-center space-x-2">
                <input type="radio" name="paymentMethod" value="debitCreditCard" class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
                <span>Debit/Credit Card</span>
              </span>
              <img src="assets/credit card.png" alt="Debit/Credit Card" class="w-8 h-5">
            </label>

            <!-- Gcash -->
            <label class="flex items-center justify-between p-4 bg-white border border-black rounded-md shadow-md cursor-pointer">
              <span class="flex items-center space-x-2">
                <input type="radio" name="paymentMethod" value="gcash" class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
                <span>Gcash</span>
              </span>
              <img src="assets/gcash.png" alt="Gcash" class="w-12 h-15">
            </label>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Section: Order Summary -->
<div class="sticky top-0 h-screen col-span-1 overflow-auto">
  <div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="mb-4 text-lg font-bold">Order Summary</h2>
    <table class="w-full text-sm text-left text-gray-500">
      <thead class="text-xs uppercase bg-[#E9B303]">
        <tr>
          <th scope="col" class="px-6 py-3 text-white">Item</th>
          <th scope="col" class="px-6 py-3 text-white">Qty.</th>
          <th scope="col" class="px-6 py-3 text-white">Price</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="px-6 py-4">
            <div class="flex flex-col font-bold text-black">
              <span>Iced Americano</span>
              <span class="font-medium text-gray-400">Php 110.00</span>
            </div>
          </td>
          <td class="px-6 py-4">2</td>
          <td class="flex items-center justify-between px-6 py-4 font-bold text-black">
            Php 220.00
            <!-- Edit Icon Button -->
            <button class="ml-2 text-gray-500 hover:text-[#E9B303]">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-4.036a2.5 2.5 0 113.536 3.536l-9.192 9.193a2 2 0 01-.878.512l-5.671 1.414a1 1 0 01-1.213-1.213l1.414-5.671a2 2 0 01.512-.878l9.193-9.192z" />
              </svg>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

        <!-- Price Summary Section -->
        <div class="mt-4">
          <div class="flex justify-between pt-2 mt-4 text-gray-700 border-t">
            <p>Subtotal</p>
            <p>Php 220.00</p>
          </div>
          <div class="flex justify-between mt-2 text-gray-700">
            <p>Delivery fee</p>
            <p>Php 50.00</p>
          </div>
          <div class="flex justify-between pt-2 mt-4 font-bold text-black border-t">
            <p>Total</p>
            <p>Php 270.00</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
              
          <!-- Sticky Footer -->
<div class="fixed bottom-0 left-0 right-0 flex items-center justify-between p-4 bg-white shadow-md">
  <!-- Total -->
  <div>
    <p class="px-40 text-sm font-medium text-gray-500">Total</p>
    <p class="px-40 text-lg font-bold text-black">Php 270.00</p>
  </div>

  <!-- Place Order Section -->
<div class="flex items-center justify-between px-3">
  <!-- Add Order Button -->
  <button class="px-4 py-2 font-bold text-[#E9B303] rounded-full w-60 border" style="background-color: #FFFFFF; border-color: #E9B303;">
    Add Order
</button>


  <!-- Place Order and Terms -->
  <div class="flex items-center px-5 space-x-4">
    <!-- Place Order Button -->
    <button class="px-10 py-2 font-bold text-white rounded-full w-60" style="background-color: #0FAF00; hover:bg-[#0E9F00];">
      Place Order
    </button>

    <!-- Terms and Conditions -->
    <div class="flex items-center">
      <!-- Checkbox -->
      <input
        type="checkbox"
        class="w-5 h-5 text-black border-gray-300 rounded focus:ring-0"
        id="terms-checkbox"
      />
      <!-- Text -->
      <label for="terms-checkbox" class="ml-2 text-sm text-gray-500">
        I agree to the 
        <a href="#" class="text-blue-500 underline">Terms and Conditions</a>
        & 
        <a href="#" class="text-blue-500 underline">Privacy Policy</a>.
      </label>
    </div>
  </div>
</div>

  
</body>
</html>
