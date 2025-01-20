<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('favicon.ico') }}?v=2" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&display=swap">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/order-now.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- @vite(['resources/js/app.js', 'resources/css/app.css']) --}}

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }
        html {
            height: 100%;
        }
        .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }
        .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        .active {
        border-bottom: 2px solid black;
    }
    .menu-button {
            transition: border-bottom 0.3s ease, color 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <header class="sticky top-0 z-20" style="height: 80px; box-shadow: 0 4px 6px rgba(139, 69, 19, 0.3); background-color: #066744;">
        <div class="container flex items-center justify-between h-full px-4 mx-auto">
            <!-- Logo and Text -->
            <div class="flex items-center space-x-3">
                <img src="assets/Caffeinated Logo.png" alt="Caffeinated Logo" class="w-12 h-12">
                <div class="flex items-center">
                    <div>
                        <span class="text-2xl font-bold leading-none text-white">CAFFEINATED</span>
                        <p class="text-sm font-medium text-white">Food Delivery</p>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="hidden ml-8 space-x-8 md:flex">
                        <a href=" {{ route('landing') }} "
                            class="text-lg font-bold text-gray-700 hover:text-[#E9B303]">Home</a>
                        <a href="{{ route('order-now') }}"
                            class="text-lg font-bold text-gray-700 hover:text-[#E9B303]">Menu</a>
                        <a href="#                       "
                            class="text-lg font-bold text-gray-700 hover:text-[#E9B303]">Orders</a>
                    </nav>
                </div>
            </div>
            <!-- Search Bar, Basket Icon, and Buttons -->
            <div class="flex items-center space-x-2">
                <!-- Search Bar -->
                <div class="relative">
                    <input id="searchInput" type="text" placeholder="Search..." name="search" value=""
                        oninput="searchProducts()"
                        class="w-64 h-10 px-4 text-sm border rounded-full focus:outline-none focus:ring-2 focus:ring-[#E9B303] border-gray-300" />
                    <button id="searchButton" class="absolute top-0 right-2 h-full text-gray-500 hover:text-[#E9B303]">
                        <img src="assets/Search.png" alt="Search Icon" class="w-5 h-5">
                    </button>
                </div>

                <!-- Basket Icon -->
                <button class="relative flex items-center basketBtn">
                    <img src="assets/order-bag.png" alt="Order Bag" class="w-12 h-12">
                    <span
                        id="basketCounter"
                        class="absolute top-0 right-0 flex items-center justify-center w-4 h-5 text-xs text-white bg-red-500 rounded-full basketCounter">
                        0</span>
                </button>

                <!-- Guest Button -->
                <button
                    class="flex items-center justify-center w-40 h-10 px-6 py-3 text-lg text-black bg-white rounded-full hover:bg-brown-600">
                    <img src="{{ asset('assets/Male User.png') }}" alt="User" class="w-5 h-5 mr-2">Guest
                </button>

                {{-- <!-- My Account Button -->
                <button class="px-4 py-2 text-sm text-gray-700 rounded-md bg-brown-500 hover:bg-brown-600">
                    My account
                </button> --}}
            </div>
        </div>
    </header>

    {{-- main content --}}
    <div class="container flex w-full">
        {{-- menu and header --}}
        <div class="w-full content">
            <div>
                <!-- Menu header -->
                <div class="relative sticky z-10 h-40 bg-center bg-cover"
                    style="background-image: url('assets/coffee-shop-bg.png'); margin-bottom: 0;">
                    <div class="absolute inset-0 flex flex-col items-center justify-center bg-black bg-opacity-30">
                        <h1 class="text-5xl font-bold text-white">MENU</h1>
                        <p class="mt-2 text-2xl font-light text-white">What are you craving today?</p>
                    </div>
                </div>

                <!-- Tabs Section for Filtering -->
                <div class="z-10 bg-white shadow-md top-60">
                    <div class="flex py-4 space-x-4 overflow-x-auto md:space-x-8 whitespace-nowrap scrollbar-hide">
                        <button onclick="filterProducts('all');"
                            class="px-4 py-2 text-lg font-medium text-black "
                            style="margin-left:15px;">
                            All Menu
                        </button>

                        @foreach ($categories as $category)
                            <button onclick="filterProducts('{{ $category->category_number }}'); setActive(this);"
                                class="px-4 py-2 text-lg font-medium text-black hover:text-black-800 menu-button">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <script>
                    function setActive(button) {
                        // Remove active class from all buttons
                        const buttons = document.querySelectorAll('.menu-button');
                        buttons.forEach(btn => btn.classList.remove('active'));

                        // Add active class to clicked button
                        button.classList.add('active');
                    }

                    function filterProducts(category) {
                        // Implement your filtering logic here
                        console.log('Filtering products by category:', category);
                    }
                </script>



            <main class="container px-12 py-8 mx-auto">
                {{-- header for searching --}}
                <section id="search-header" class="hidden mb-12 search-header">
                    <h3 class="mb-4 text-2xl font-semibold text-brown-700"></h3>
                </section>
                <!-- Grouped Products by Categories -->
                @foreach ($categories as $category)
                    <section class="mb-12 category-section" data-category="{{ $category->category_number }}">
                        <h3 class="mb-4 text-2xl font-semibold text-brown-700">{{ $category->name }}</h3>
                        <div class="grid grid-cols-1 gap-x-5 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                            @foreach ($products as $product)
                                @if ($product->category_number === $category->category_number)
                                    <!-- Product Cards -->
                                    <div class="mx-auto bg-white rounded-lg shadow-md product-card w-70"
                                        data-name="{{ $product->name }}">
                                        <!-- Product Image -->
                                        <div class="p-4">
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                                class="object-cover w-full rounded-lg h-44">
                                        </div>
                                        <!-- Product Name -->
                                        <div class="text-center">
                                            <h4 class="mb-2 text-lg font-bold text-gray-800">{{ $product->name }}</h4>
                                        </div>
                                        {{-- Product Price --}}
                                        <div class="text-center">
                                            <span class="text-lg font-bold text-gray-800">₱{{ $product->price }}</span>
                                        </div>
                                        <!-- Add to Bag Button -->
                                        <button id="addToBagBtn" data-category="{{ $category->name }}"
                                            class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition"
                                            onclick='openModal(@json(['product' => $product, 'category' => $category]))'>
                                            Add to bag
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </main>
        </div>

        <!-- Order Summary Sidebar -->
        <div class="sidebar fixed top-20 right-0 h-[calc(100vh-80px)] bg-white shadow-md w-96 z-20 flex flex-col">
            <!-- Order Summary Header -->
            <div class="p-6">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">Order Summary</h2>
                <!-- Column Headings -->
                <div class="flex justify-between pb-2 mb-2 border-b">
                    <span class="font-medium text-gray-600">Item</span>
                    <span class="font-medium text-gray-600">Qty</span>
                    <span class="font-medium text-gray-600">Price</span>
                </div>

                <!-- Order Items -->
                <div id="order-cart" class="flex flex-col order-cart">
                    {{-- items added to cart goes here --}}
                </div>

                <!-- Order Note -->
                <div class="flex items-center mt-4">
                    <textarea id="orderNote" rows="1" placeholder="Order Note..."
                        class="orderNote flex-grow p-2 text-xs text-gray-700 bg-gray-100 border rounded focus:outline-none focus:ring-2 focus:ring-[#E9B303]"></textarea>
                    <!-- Trash Can Icon -->
                    <button onclick="deleteNote()" ="ml-2 text-gray-500 hover:text-red-600">
                        <img src="assets/trashcan.png" alt="Trash Can" class="h-10 w-7" />
                    </button>
                </div>
            </div>

            <!-- Subtotal, Delivery Fee, and Total Section -->
            <div class="p-6 pb-10 mt-auto border-t bg-gray-50">
                <div class="flex justify-between text-gray-800">
                    <span>Subtotal</span>
                    <span id="orderSubtotal" class="order-subtotal">₱ 0.00</span>
                </div>
                <div class="flex justify-between mt-2 text-gray-800">
                    <span>Tax</span>
                    <span id="orderTax" class="order-tax">₱ 0.00</span>
                </div>
                <div class="flex justify-between mt-2 text-gray-800">
                    <span>Delivery Fee</span>
                    <span id="deliveryFee" class="order-delivery-fee">₱ 50.00</span>
                </div>
                <div class="flex justify-between mt-4 text-lg font-bold text-gray-800">
                    <span>Total</span>
                    <span id="orderTotal" class="order-total">₱ 0.00</span>
                </div>
                <!-- Checkout Button -->
                <button id="checkoutBtn" onclick="checkout()" class="w-full py-3 mt-6 text-white bg-green-500 rounded-3xl hover:bg-green-600">
                    Checkout
                </button>
            </div>
        </div>
    </div>

    <!-- General Modal -->
    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-[#E9B303] w-[455px] h-[590px] rounded-lg shadow-lg p-6">
            <div class="text-center">
                <!-- Header -->
                <h2 class="mb-4 text-2xl font-bold text-white">Customize your order</h2>

                {{-- Product Id --}}
                <div id="modalProductId" class="hidden"></div>

                <!-- Product Image -->
                <img id="modalProductImage" src="" alt=""
                    class="mx-auto w-[350px] h-[200px] rounded-lg mb-4">

                <!-- Product Title -->
                <h3 id="modalProductTitle" class="mb-2 text-2xl font-semibold text-white"></h3>
                <p id="modalProductCategory" class="mb-4 text-lg text-white"></p>

                <!-- Total Price -->
                <p id="modalProductPrice" class="mb-4 text-xl font-semibold text-white p"></p>

                <!-- Quantity Selector -->
                <div class="flex items-center justify-center pb-5 mb-6">
                    <button onclick="modalChangeQuantity(-1)" id="decreaseBtn" class="px-4 py-2 text-xl font-bold text-white bg-black rounded-full">
                        -</button>
                    <span id='quantity' class="mx-6 text-xl text-white">
                        1</span>
                    <button onclick="modalChangeQuantity(1)" id="increaseBtn" class="px-4 py-2 text-xl font-bold text-white bg-black rounded-full">
                        +</button>
                </div>

                <!-- Add to Bag Button -->
                <button onclick="addToMyBag()" id="closeModalBtn" class="w-full py-3 text-sm font-semibold text-white bg-black rounded-full">
                    Add to my bag
                </button>
            </div>
        </div>
    </div>
</body>

</html>
