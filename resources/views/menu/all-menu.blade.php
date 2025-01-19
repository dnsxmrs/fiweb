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

<body class="bg-gray-100">
    <!-- Navbar -->
    <header class="sticky top-0 z-10" style="height: 80px; box-shadow: 0 4px 6px rgba(139, 69, 19, 0.3); background-color: #066744;">
        <div class="container flex items-center justify-between h-full px-4 mx-auto" style="background-color:#066744">
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
                    <input id="searchInput" type="text" placeholder="Search..."
                        class="w-64 h-10 px-4 text-sm border rounded-full focus:outline-none focus:ring-2 focus:ring-[#E9B303] border-gray-300" />
                    <button id="searchButton" class="absolute top-0 right-2 h-full text-gray-500 hover:text-[#E9B303]">
                        <img src="assets/Search.png" alt="Search Icon" class="w-5 h-5">
                    </button>
                </div>



                <!-- Basket Icon -->
                <button class="relative flex items-center">
                    <img src="assets/order-bag.png" alt="Order Bag" class="w-12 h-12">
                    <span
                        class="absolute top-0 right-0 flex items-center justify-center w-4 h-5 text-xs text-white bg-red-500 rounded-full">3</span>
                </button>

                <!-- Guest Button -->
                <button
                    class="flex items-center justify-center w-40 h-10 px-6 py-3 text-lg text-white bg-black rounded-full hover:bg-brown-600">
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
    <div class="flex py-4 space-x-4 overflow-x-auto md:space-x-8 whitespace-nowrap scrollbar-hide">
        <button class="inline-block px-4 py-2 text-lg font-medium text-black border-b-2 border-black hover:text-black-800">All Menu</button>
        <button class="inline-block px-4 py-2 font-medium text-black hover:text-black-800">Coffee</button>
        <button class="inline-block px-4 py-2 font-medium text-black hover:text-black-800">Non-coffee</button>
        <button class="inline-block px-4 py-2 font-medium text-black hover:text-black-800">Frappuccino</button>
        <button class="inline-block px-4 py-2 font-medium text-black hover:text-black-800">Snack</button>
        <button class="inline-block px-4 py-2 font-medium text-black hover:text-black-800">Dessert</button>
    </div>
</div>





    <!-- Menu Section -->
    <main class="container px-4 py-8 mx-auto">

        <!-- Cold Drinks Modal -->
        <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="bg-[#E9B303] w-[450px] h-[810px] rounded-lg shadow-lg p-6">
                <div class="text-center">
                    <!-- Header -->
                    <h2 class="mb-4 text-2xl font-bold text-white">Customize your order</h2>

                    <!-- Product Image -->
                    <img src="assets/Iced_Americano.png" alt="Americano" class="mx-auto w-[378px] h-[243px] rounded-lg mb-4">

                    <!-- Product Title -->
                    <h3 class="mb-2 text-3xl font-semibold text-white">Americano</h3>
                    <p class="mb-6 text-lg text-white">Iced Coffee</p>

                    <!-- Quantity Selector -->
                    <div class="flex items-center justify-center mb-6">
                        <button class="px-4 py-2 text-2xl font-bold text-white bg-black rounded-full">-</button>
                        <span class="mx-6 text-2xl text-white">2</span>
                        <button class="px-4 py-2 text-2xl font-bold text-white bg-black rounded-full">+</button>
                    </div>

                    <!-- Size Options -->
                    <h4 class="mb-4 text-lg font-semibold text-white">Choose your drink size</h4>
                    <div class="flex justify-center gap-4 mb-6">
                        <!-- Size Option 1 -->
                        <button
                            class="flex flex-col items-center justify-center w-24 h-32 bg-gray-200 rounded-lg shadow-md hover:bg-white hover:shadow-lg">
                            <img src="assets/coffee size.png" alt="16oz cup" class="w-12 h-12 mb-2">
                            <span class="text-sm font-semibold text-gray-500 hover:text-[#E9B303]">16oz</span>
                            <span class="text-sm text-gray-400 hover:text-gray-500">(Php 110.00)</span>
                        </button>

                        <!-- Size Option 2 -->
                        <button
                            class="flex flex-col items-center justify-center w-24 h-32 bg-gray-200 rounded-lg shadow-md hover:bg-white hover:shadow-lg">
                            <img src="assets/coffee size.png" alt="16oz cup" class="w-12 h-12 mb-2">
                            <span class="text-sm font-semibold text-gray-500 hover:text-[#E9B303]">22oz</span>
                            <span class="text-sm text-gray-400 hover:text-gray-500">(Php 120.00)</span>
                        </button>
                    </div>
                    <!-- Add to Bag Button -->
                    <button id="closeModalBtn" class="py-3 text-lg font-semibold text-white bg-black w-[378px] rounded-3xl">
                        Add to my bag
                    </button>
                </div>
            </div>
        </div>

        <!-- Hot Drinks Modal -->
        <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
            <div class="bg-[#E9B303] w-[450px] h-[810px] rounded-lg shadow-lg p-6">
                <div class="text-center">
                    <!-- Header -->
                    <h2 class="mb-4 text-2xl font-bold text-white">Customize your order</h2>

                    <!-- Product Image -->
                    <img src="assets/Iced_Americano.png" alt="Americano" class="mx-auto w-[350px] h-[200px] rounded-lg mb-4">

                    <!-- Product Title -->
                    <h3 class="mb-2 text-xl font-semibold text-white">Americano</h3>
                    <p class="mb-4 text-sm text-white">Hot Coffee</p>

                    <!-- Drink Size Section -->
                    <h4 class="mb-4 text-lg font-semibold text-white">Choose your drink size</h4>
                    <div class="flex flex-col items-center mb-4">
                        <div class="flex flex-col items-center bg-gray-200 rounded-lg shadow-md w-[100px] h-[140px]">
                            <img src="assets/coffee size.png" alt="8oz cup" class="w-12 h-12 mt-4">
                            <span class="mt-2 text-sm font-semibold text-gray-700">8oz</span>
                            <span class="text-sm text-gray-500">(Php 95.00)</span>
                        </div>
                    </div>

                    <!-- Total Price -->
                    <p class="pb-5 mb-4 text-lg font-semibold text-white">Php 95.00</p>

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


    </main>

    <!-- Snacks/Dessert Modal -->
    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-[#E9B303] w-[455px] h-[590px] rounded-lg shadow-lg p-6">
            <div class="text-center">
                <!-- Header -->
                <h2 class="mb-4 text-2xl font-bold text-white">Customize your order</h2>

                <!-- Product Image -->
                <img src="assets/Iced_Americano.png" alt="Americano"
                    class="mx-auto w-[350px] h-[200px] rounded-lg mb-4">

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

        document.getElementById('searchButton').addEventListener('click', function() {
            document.getElementById('searchInput').focus();
        });
    </script>

</body>

</html>
