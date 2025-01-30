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
            font-family: 'Poppins', sans-serif;
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
                    <input id="searchInput" type="text" placeholder="Search..."
                        class="w-64 h-10 px-4 text-sm border rounded-full focus:outline-none focus:ring-2 focus:ring-[#E9B303] border-gray-300" />
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


    <div>
        <!-- Order Summary Sidebar -->
        <aside class="fixed top-20 right-0 h-[calc(100vh-80px)] bg-white shadow-md w-96 z-10 flex flex-col">
            <!-- Order Summary Header -->
            <div class="p-6">
                <h2 class="mb-4 text-l font-semibold text-gray-800">Order Summary</h2>
                <!-- Column Headings -->
                <div class="flex justify-between pb-2 mb-2 border-b">
                    <span class="font-medium text-gray-600">Item</span>
                    <span class="font-medium text-gray-600">Qty</span>
                    <span class="font-medium text-gray-600">Price</span>
                </div>

                <!-- Order Items -->
                <div class="flex flex-col">
                    <!-- Item -->
                    <div class="flex items-center justify-between py-3 border-b">
                        <!-- Item Details -->
                        <div class="flex items-center">
                            <div>
                                <p class="font-medium text-gray-800">Iced Americano</p>
                                <p class="text-sm text-gray-500">Php 110.00</p>
                            </div>
                        </div>

                        <!-- Quantity Selector -->
                        <div class="flex items-center">
                            <button class="px-2 py-1 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">-</button>
                            <span class="px-4 text-gray-800">2</span>
                            <button class="px-2 py-1 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">+</button>
                        </div>

                        <!-- Price -->
                        <div class="flex items-center">
                            <p class="mr-4 font-medium text-gray-800">Php 220.00</p>
                        </div>
                    </div>
                </div>

                <!-- Order Note -->
                <div class="flex items-center mt-4">
                    <textarea id="orderNote" rows="1" placeholder="Order Note..."
                        class="flex-grow p-2 text-xs text-gray-700 bg-gray-100 border rounded focus:outline-none focus:ring-2 focus:ring-[#E9B303]"></textarea>
                    <!-- Trash Can Icon -->
                    <button class="ml-2 text-gray-500 hover:text-red-600">
                        <img src="assets/trashcan.png" alt="Trash Can" class="h-10 w-7">
                    </button>
                </div>
            </div>

            <!-- Subtotal, Delivery Fee, and Total Section -->
            <div class="p-6 pb-10 mt-auto border-t bg-gray-50">
                <div class="flex justify-between text-gray-800">
                    <span>Subtotal</span>
                    <span>Php 220.00</span>
                </div>
                <div class="flex justify-between mt-2 text-gray-800">
                    <span>Delivery Fee</span>
                    <span>Php 50.00</span>
                </div>
                <div class="flex justify-between mt-4 text-lg font-bold text-gray-800">
                    <span>Total</span>
                    <span>Php 270.00</span>
                </div>
                <!-- Checkout Button -->
                <button class="w-full py-3 mt-6 text-white bg-green-500 rounded-3xl hover:bg-green-600">
                    Checkout
                </button>
            </div>
        </aside>
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
