<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('favicon.ico') }}?v=2" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&display=swap">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <script src="{{ asset('js/orders.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script> --}}

    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        html {
            height: 100%;
        }

        select:focus {
            outline: none;
            border-color: #E9B303;
            box-shadow: 0 0 0 2px #E9B303;
        }

        select::placeholder {
            color: #4A5568;
            /* Dark gray placeholder */
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
    <header class="sticky top-0 z-20"
        style="height: 80px; box-shadow: 0 4px 6px rgba(139, 69, 19, 0.3); background-color: #066744;">
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
                        <a href="{{ route('showDetails') }}"
                            class="text-lg font-bold text-gray-700 hover:text-[#E9B303]">Orders</a>
                    </nav>
                </div>
            </div>
            <!-- Search Bar, Basket Icon, and Buttons -->
            <div class="flex items-center space-x-2">
                <!-- Search Bar -->
                {{-- <div class="relative">
                    <input id="searchInput" type="text" placeholder="Search for products..." name="search" value=""
                        oninput="searchProducts()"
                        class="w-64 h-10 px-4 text-sm border rounded-full focus:outline-none focus:ring-2 focus:ring-[#E9B303] border-gray-300" />
                    <button id="searchButton" class="absolute top-0 right-2 h-full text-gray-500 hover:text-[#E9B303]">
                        <img src="assets/Search.png" alt="Search Icon" class="w-5 h-5">
                    </button>
                </div> --}}

                <!-- Basket Icon -->
                <button class="relative flex items-center basketBtn">
                    <img src="assets/order-bag.png" alt="Order Bag" class="w-12 h-12">
                    <span id="basketCounter"
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


    <body class="bg-gray-100">
        <!-- Order Status Section -->
        <div class="w-[720px] mx-auto mt-10 bg-white rounded-lg shadow-lg p-6">
            <h2 class="mb-4 text-lg font-bold text-gray-700">Order Status</h2>
            <div>
                <div class="flex flex-col items-center">
                    <img src="assets/Caffeinated Logo.png" alt="Coffee Icon" class="h-40 mb-10 w-35">
                    <!-- Order Status -->
                    <ul class="space-y-4">
                        // pending
                        <li class="flex items-center space-x-2">
                            <span class="w-4 h-4 bg-gray-300 rounded-full"></span>
                            <span class="text-gray-500">Order being validated</span>
                        </li>
                        // preparing
                        <li class="flex items-center space-x-2">
                            <span class="w-4 h-4 bg-[#E9B303] rounded-full"></span>
                            <span class="font-semibold text-black">Order being prepared</span>
                        </li>
                        // ready
                        <li class="flex items-center space-x-2">
                            <span class="w-4 h-4 bg-gray-300 rounded-full"></span>
                            <span class="text-gray-500">Rider on his way</span>
                        </li>
                        // completed
                        <li class="flex items-center space-x-2">
                            <span class="w-4 h-4 bg-gray-300 rounded-full"></span>
                            <span class="text-gray-500">Delivery on its way</span>
                        </li>
                        // ????
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
                {{-- @foreach ($orderProducts as $item)
                    <div class="flex justify-between py-2">
                        <span class="text-black product_name">{{ $item->product->name }}</span>
                        <span class="text-center product_price">Php {{ number_format($item->price, 2) }}</span>
                        <span class="text-center quantity">{{ $item->quantity }}</span>
                        <span class="text-right total_price">Php {{ number_format($item->price * $item->quantity, 2) }}</span>
                    </div>
                @endforeach --}}

                @isset($orderProducts)
                    {{-- Display content when $orderProducts is passed and not null --}}
                    @foreach ($orderProducts as $item)
                        <div class="flex justify-between py-2">
                            <span class="product_name text-black">{{ $item->product->name }}</span>
                            <span class="product_price text-center">Php {{ number_format($item->price, 2) }}</span>
                            <span class="quantity text-center">{{ $item->quantity }}</span>
                            <span class="total_price text-right">Php
                                {{ number_format($item->price * $item->quantity, 2) }}</span>
                        </div>
                    @endforeach
                @else
                    <div class="py-2 text-center text-gray-500">
                        No products available.
                    </div>
                @endisset

                <!-- Divider -->
                <div class="my-4 border-t"></div>
                @isset($orders)
                    <!-- Subtotal -->
                    <div class="flex justify-between py-2">
                        <span class="text-gray-700">Subtotal</span>
                        <span class="text-right subtotal">Php {{ number_format($orders->subtotal, 2) }}</span>
                    </div>

                    <!-- Delivery Fee -->
                    <div class="flex justify-between py-2">
                        <span class="text-gray-700">Delivery fee</span>
                        <span class="text-right delivery_fee">Php {{ number_format($orders->delivery_fee, 2) }}</span>
                    </div>

                    <!-- Divider -->
                    <div class="my-4 border-t"></div>

                    <!-- Total -->
                    <div class="flex justify-between py-2 font-bold">
                        <span class="text-black">Total</span>
                        <span class="text-right total">Php {{ number_format($orders->total, 2) }}</span>
                    </div>
                @else
                    <!-- Subtotal -->
                    <div class="flex justify-between py-2">
                        <span class="text-gray-700">Subtotal</span>
                        <span class="text-right subtotal">Php 0.00</span>
                    </div>

                    <!-- Delivery Fee -->
                    <div class="flex justify-between py-2">
                        <span class="text-gray-700">Delivery fee</span>
                        <span class="text-right delivery_fee">Php 50.00</span>
                    </div>

                    <!-- Divider -->
                    <div class="my-4 border-t"></div>

                    <!-- Total -->
                    <div class="flex justify-between py-2 font-bold">
                        <span class="text-black">Total</span>
                        <span class="text-right total">Php 0.00</span>
                    </div>
                @endisset

            </div>
        </div>

        <!-- Payment Section -->
        <div class="w-[720px] mx-auto mb-20 mt-10 bg-white rounded-lg shadow-lg p-6">
            @isset($orders, $payments)
                <h2 class="mb-2 text-lg font-bold text-gray-700">Payment</h2>
                <p class="text-gray-700 payment_type">{{ ucfirst($payments->payment_type) }}</p>

                <!-- Divider -->
                <div class="my-4 border-t"></div>

                <!-- Order Details Section -->
                <h2 class="mt-6 mb-4 text-lg font-bold text-gray-700">Order Details</h2>
                <div class="space-y-6">
                    <div class="flex justify-between">
                        <span class="text-gray-700">Order Number</span>
                        <span class="font-medium text-black order_number">{{ $orders->order_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Contact Number</span>
                        <span class="font-medium text-black contact_number">{{ $orders->contact_number }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Delivery Address</span>
                        <span class="ml-12 font-medium text-right text-black address">
                            {{ $orders->street }}, {{ $orders->barangay }}, {{ $orders->municipality }},
                            {{ $orders->province }}, {{ $orders->region }} ({{ $orders->address_type }}),
                            Philippines
                        </span>
                    </div>
                </div>
            @else
                <h2 class="mb-2 text-lg font-bold text-gray-700">Payment</h2>
                <p class="text-gray-700 payment_type"></p>
                <!-- Divider -->
                <div class="my-4 border-t"></div>
                <!-- Order Details Section -->
                <h2 class="mt-6 mb-4 text-lg font-bold text-gray-700">Order Details</h2>
                <div class="space-y-6">
                    <div class="flex justify-between">
                        <span class="text-gray-700">Order Number</span>
                        <span class="font-medium text-black order_number"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Contact Number</span>
                        <span class="font-medium text-black contact_number"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-700">Delivery Address</span>
                        <span class="ml-12 font-medium text-right text-black address">
                        </span>
                    </div>
                </div>
            @endisset
            <!-- Divider -->
            <div class="my-4 border-t"></div>

            <!-- Cancel Order Button -->
            <div class="mt-6 text-center">
                <button class="w-[175px] h-[50px] text-lg font-bold text-white bg-red-600 rounded-lg hover:bg-red-700">
                    Cancel Order
                </button>
            </div>
        </div>
        <script>
            sessionStorage.clear();
        </script>

    </body>

</html>
