<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('favicon.ico') }}?v=2" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- <script src="{{ asset('js/checkout.js') }}" defer></script> --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- @vite(['resources/js/app.js']) --}}

    <style>
        body {
            font-family: 'Poppins', sans-serif;
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

        label:has(+ .border-red-500) {
            color: #f87171;
            /* Label text turns red */
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
                    <nav class="hidden ml-12 space-x-8 md:flex">
                        <a href=" {{ route('landing') }} "
                            class="text-base font-normal text-white hover:text-[#E9B303]">Home</a>
                    </nav>
                </div>
            </div>
            <!-- Search Bar, Basket Icon, and Buttons -->
            <div class="flex items-center space-x-2">
                <!-- Basket Icon -->
                <button class="relative flex items-center basketBtn">
                    <img src="assets/order-bag.png" alt="Order Bag" class="w-12 h-12">
                    <span
                        id="basketCounter"
                        class="absolute top-0 right-0 flex items-center justify-center w-4 h-5 text-xs text-white bg-red-500 rounded-full basketCounter">
                        0</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Menu Section -->
    <main class="container px-4 pb-8 pt-1 mx-auto">


        <div class="container px-6 pb-6 pt-1 mx-auto">

            <!-- Main Layout -->
            <main class="container px-4 pb-8 pt-1 mx-auto">
                <div class="py-8">
                    <a href="{{ url()->previous() }}" class="btn btn-default inline-flex items-center text-black-700 hover:text-[#E9B303] focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5l-7 7 7 7"></path>
                        </svg>
                        Back to menu page
                    </a>
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">


                    <!-- Left Section: Contact and Address Details -->
                    <div class="col-span-2 space-y-4">
                        <!-- Contact Details -->
                        <div class="p-6 bg-white rounded-lg shadow-md">
                            <h2 class="mb-4 text-lg font-bold">Contact Details</h2>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                <div>
                                    <label for="firstName" class="block text-sm font-medium text-gray-700">First
                                        Name<span class="text-red-500"> *</span></label>
                                    <input required type="text" id="firstName" placeholder="Juan"
                                        class="validate mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
                                </div>
                                <div>
                                    <label for="lastName" class="block text-sm font-medium text-gray-700">Last
                                        Name<span class="text-red-500"> *</span></label>
                                    <input type="text" id="lastName" placeholder="dela Cruz"
                                        class="validate mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-2">
                                <div>
                                    <label for="contactNumber" class="block text-sm font-medium text-gray-700">Contact
                                        Number<span class="text-red-500"> *</span>
                                    </label>
                                    <input type="text" id="contactNumber" placeholder="09123456789"
                                        class="validate mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
                                        <p id="cnValidation" class="hidden pt-1 text-xs font-medium text-red-500">
                                            Input Philippine phone number</p>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">
                                        Email<span class="text-red-500"> *</span>
                                    </label>
                                    <input type="email" id="email" placeholder="email@gmail.com"
                                        class="validate mt-1 block w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
                                        <p id="eaValidation" class="hidden pt-1 text-xs font-medium text-red-500">
                                            Input valid gmail address</p>
                                </div>
                            </div>
                        </div>

                        <!-- Address Details -->
                        <div class="p-6 bg-white rounded-lg shadow-md">
                            <h2 class="mb-4 text-lg font-bold">Deliver to</h2>
                            {{-- REGION DROPDOWN --}}
                            <div>
                                <label for="region" class="block text-sm font-medium text-gray-700">
                                    Region<span class="text-red-500"> *</span></label>
                                <div class="relative mt-1">
                                    <select id="region"
                                        class="validate w-full px-4 py-3 bg-gray-100 text-black border border-gray-300 rounded-md appearance-none focus:ring-[#E9B303] focus:border-[#E9B303]">
                                        <option value="" disabled selected>Select a region</option>
                                    </select>
                                    <!-- Dropdown Icon -->
                                    <div class="absolute inset-y-0 flex items-center pointer-events-none right-3">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- PROVINCE DROPDOWN --}}
                            <div class="mt-4">
                                <label for="province" class="block text-sm font-medium text-gray-700">
                                    Province<span class="text-red-500"> *</span></label>
                                <div class="relative mt-1">
                                    <select id="province"
                                        class="validate w-full px-4 py-3 bg-gray-100 text-black border border-gray-300 rounded-md appearance-none focus:ring-[#E9B303] focus:border-[#E9B303]">
                                        <option value="" disabled selected>Select a province</option>
                                    </select>
                                    <!-- Dropdown Icon -->
                                    <div class="absolute inset-y-0 flex items-center pointer-events-none right-3">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- MUNICIPALITY DROPDOWN --}}
                            <div class="mt-4">
                                <label for="municipality" class="block text-sm font-medium text-gray-700">
                                    Municipality<span class="text-red-500"> *</span></label>
                                <div class="relative mt-1">
                                    <select id="municipality"
                                        class="validate w-full px-4 py-3 bg-gray-100 text-black border border-gray-300 rounded-md appearance-none focus:ring-[#E9B303] focus:border-[#E9B303]">
                                        <option value="" disabled selected>Select a municipality</option>
                                    </select>
                                    <!-- Dropdown Icon -->
                                    <div class="absolute inset-y-0 flex items-center pointer-events-none right-3">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- BARANGAY DROPDOWN --}}
                            <div class="mt-4">
                                <label for="barangay" class="block text-sm font-medium text-gray-700">
                                    Barangay<span class="text-red-500"> *</span></label>
                                <div class="relative mt-1">
                                    <select id="barangay"
                                        class="validate w-full px-4 py-3 bg-gray-100 text-black border border-gray-300 rounded-md appearance-none focus:ring-[#E9B303] focus:border-[#E9B303]">
                                        <option value="" disabled selected>Select a barangay</option>
                                    </select>
                                    <!-- Dropdown Icon -->
                                    <div class="absolute inset-y-0 flex items-center pointer-events-none right-3">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {{-- STREET/UNIT --}}
                            <div class="mt-4">
                                <label for="street" class="block text-sm font-medium text-gray-700">Street/Building
                                    Name<span class="text-red-500"> *</span>
                                </label>
                                <input type="text" id="street" placeholder="Strawberry Street"
                                    class="validate mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
                            </div>

                            {{-- UNIT/FLOOR --}}
                            <div class="mt-4">
                                <label for="unit" class="block text-sm font-medium text-gray-700">Unit/Floor<span
                                        class="text-red-500"> *</span>
                                </label>
                                <input type="text" id="unit" placeholder="Block 33 Lot 8 Phase 1A"
                                    class="validate mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
                            </div>

                            {{-- ADDRESS TYPE --}}
                            <div class="mt-4">
                                <span class="block text-sm font-medium text-gray-700">Select address type<span
                                        class="text-red-500"> *</span>
                                    <div class="flex items-center mt-1 space-x-4">
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="addressType" value="Residential" checked
                                                class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
                                            <span>Residential</span>
                                        </label>
                                        <label class="flex items-center space-x-2">
                                            <input type="radio" name="addressType" value="Office"
                                                class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
                                            <span>Office</span>
                                        </label>
                                    </div>
                            </div>
                            {{-- <div class="mt-6">
                                    <button
                                        class="px-6 py-2 font-bold text-white bg-black rounded-md hover:bg-gray-800">Update
                                        address</button>
                                </div> --}}
                        </div>

                        <!-- Delivery Time Section -->
                        <div class="p-6 mt-6 bg-white rounded-lg shadow-md">
                            <h2 class="mb-4 text-lg font-bold">Delivery time</h2>
                            <div>
                                <label for="deliveryTime" class="block text-sm font-medium text-gray-700">
                                    Choose delivery time
                                    <span class="text-red-500"> *</span>
                                    <span class="italic text-gray-500">(for this day:
                                    <span id="dateDelivery"></span>)</span>
                                </label>
                                <div class="relative mt-2">
                                    <input type="text" id="datepickerCheckout" placeholder="Select Date"
                                        class="mt-1 block w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-md text-black focus:ring-[#E9B303] focus:border-[#E9B303]">
                                    {{-- <!-- Dropdown Icon -->
                                    <div class="absolute inset-y-0 flex items-center pointer-events-none right-3">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Payment Section -->
                        <div class="p-6 mt-6 bg-white rounded-lg shadow-md">
                            <h2 class="mb-4 text-lg font-bold">Payment</h2>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Select your preferred payment method<span
                                        class="text-red-500"> *</span>
                                    </label></p>
                                <div class="mt-4 space-y-4">
                                    <!-- Debit/Credit Card -->
                                    <label
                                        class="flex items-center justify-between p-4 bg-white border border-black rounded-md shadow-md cursor-pointer">
                                        <span class="flex items-center space-x-2">
                                            <input checked type="radio" name="paymentMethod" value="card"
                                                class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
                                            <span>Debit/Credit Card</span>
                                        </span>
                                        <img src="assets/credit card.png" alt="Debit/Credit Card" class="w-8 h-5">
                                    </label>

                                    <!-- Gcash -->
                                    <label
                                        class="flex items-center justify-between p-4 bg-white border border-black rounded-md shadow-md cursor-pointer">
                                        <span class="flex items-center space-x-2">
                                            <input type="radio" name="paymentMethod" value="gcash"
                                                class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
                                            <span>Gcash</span>
                                        </span>
                                        <img src="assets/gcash.png" alt="Gcash" class="w-12 h-15">
                                    </label>

                                    <!-- Paymaya -->
                                    <label
                                        class="flex items-center justify-between p-4 bg-white border border-black rounded-md shadow-md cursor-pointer">
                                        <span class="flex items-center space-x-2">
                                            <input type="radio" name="paymentMethod" value="paymaya"
                                                class="form-radio text-[#E9B303] focus:ring-[#E9B303]">
                                            <span>Paymaya</span>
                                        </span>
                                        <img src="assets/paymaya.png" alt="Paymaya" class="w-10 h-15">
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
                                        <th scope="col" class="py-3 pl-3 pr-1 text-center text-white">Qty.</th>
                                        <th scope="col" class="py-3 pl-1 pr-3 text-white">Price</th>
                                    </tr>
                                </thead>
                                <tbody id="orderItems">
                                    {{-- insert ordered items here thru js --}}
                                </tbody>
                            </table>

                            <!-- Price Summary Section -->
                            <div class="mt-4">
                                <div class="flex justify-between pt-2 mt-4 text-gray-700 border-t">
                                    <p>Subtotal</p>
                                    <p id="orderSubtotal"></p>
                                </div>
                                <div class="flex justify-between mt-2 text-gray-700">
                                    <p>Delivery fee</p>
                                    <p id="deliveryFee"></p>
                                </div>
                                <div class="flex justify-between pt-2 mt-4 font-bold text-black border-t">
                                    <p>Total</p>
                                    <p id="orderTotal"></p>
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
                    <p id="footerOrderTotal" class="px-40 text-lg font-bold text-black"></p>
                </div>

                <!-- Place Order Section -->
                <div class="flex items-center justify-between px-3">
                    {{-- <!-- Add Order Button -->
                    <button class="px-4 py-2 font-bold text-[#E9B303] rounded-full w-60 border"
                        style="background-color: #FFFFFF; border-color: #E9B303;">
                        Add Order
                    </button> --}}

                    <!-- Place Order and Terms -->
                    <div class="flex items-center px-5 space-x-4">
                        <!-- Place Order Button -->
                        <button id="placeOrderButton"
                            class="px-10 py-2 font-bold text-white bg-gray-400 rounded-full w-60" disabled>
                            Place Order
                        </button>

                        <!-- Terms and Conditions -->
                        <div class="flex items-center">
                            <!-- Checkbox -->
                            <input type="checkbox" class="w-5 h-5 text-black border-gray-300 rounded focus:ring-0"
                                id="terms-checkbox" />

                            <!-- Text -->
                            <label for="terms-checkbox" class="ml-2 text-sm text-gray-500">
                                    I agree to the
                                    <a href="#" class="text-blue-500 underline" onclick="openModal(event)">Terms and Conditions</a>
                                </label>

                                <!-- Modal -->
                                <div id="termsModal" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
                                    <div class="p-6 bg-white rounded-lg shadow-lg w-200">
                                        <h2 class="mb-4 text-lg font-bold">Terms and Conditions</h2>
                                        <p class="text-sm text-gray-600">Here are the terms and conditions of our service. Please read them carefully before proceeding.</p>
                                        <li>Orders once placed cannot be canceled or modified after confirmation.</li>
                                        <li>All prices are subject to change without prior notice.</li>
                                        <li>Delivery times are estimated and may vary due to external factors.</li>
                                        <li>We are not responsible for food allergies or dietary restrictions; please review menu details before ordering.</li>
                                        <li>By proceeding, you acknowledge that you have read and understood these terms.</li>
                                        {{-- <div class="flex items-center mt-4">
                                            <input type="checkbox" id="agree-checkbox" class="mr-2">
                                            <label for="agree-checkbox" class="text-sm text-gray-500">I agree to the terms and conditions</label>
                                        </div> --}}

                                        <div class="flex justify-end mt-4">
                                            <button id="submit-btn" onclick="submitAgreement()" class="px-4 py-2 text-white bg-[#066744] rounded-lg">Close</button>
                                        </div>
                                    </div>
                                </div>

                                <script>

                                </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        const basketCounterHTML = document.getElementById("basketCounter");
        const termsCheckBox = document.getElementById("terms-checkbox");
        const placeOrderBtn = document.getElementById("placeOrderButton");

        const savedOrders = sessionStorage.getItem("orderItems");
        const orderNote = sessionStorage.getItem("orderNote");
        const orderSubtotal = sessionStorage.getItem("orderSubtotal");

        const orderItems = {}; // loaded
        const currentProduct = {};
        const delivery_fee = 50;

        const prefixes = {
            '0817': 'Globe Telecom / TM',
            '0905': 'Globe Telecom / TM',
            '0906': 'Globe Telecom / TM',
            '0915': 'Globe Telecom / TM',
            '0916': 'Globe Telecom / TM',
            '0917': 'Globe Telecom / TM',
            '0926': 'Globe Telecom / TM',
            '0927': 'Globe Telecom / TM',
            '0935': 'Globe Telecom / TM',
            '0936': 'Globe Telecom / TM',
            '0937': 'ABS-CBN Mobile',
            '0945': 'Globe Telecom / TM',
            '0955': 'Globe Telecom / TM',
            '0956': 'Globe Telecom / TM',
            '0965': 'Globe Telecom / TM',
            '0966': 'Globe Telecom / TM',
            '0967': 'Globe Telecom / TM',
            '0975': 'Globe Telecom / TM',
            '0976': 'Globe Telecom / Gomo / TM',
            '0977': 'Globe Telecom / TM',
            '0995': 'Globe Telecom / TM',
            '0996': 'Cherry Prepaid',
            '0997': 'Globe Telecom / TM',
            '09175': 'Globe Postpaid',
            '09176': 'Globe Postpaid',
            '09178': 'Globe Postpaid',
            '09253': 'Globe Postpaid',
            '09255': 'Globe Postpaid',
            '09256': 'Globe Postpaid',
            '09257': 'Globe Postpaid',
            '09258': 'Globe Postpaid',
            '0813': 'Smart / TNT',
            '0907': 'Smart / TNT',
            '0908': 'Smart / TNT',
            '0909': 'Smart / TNT',
            '0910': 'Smart / TNT',
            '0811': 'Smart / TNT',
            '0912': 'Smart / TNT',
            '0913': 'Smart / TNT',
            '0914': 'Smart / TNT',
            '0918': 'Smart / TNT',
            '0919': 'Smart / TNT',
            '0920': 'Smart / TNT',
            '0921': 'Smart / TNT',
            '0928': 'Smart / TNT',
            '0929': 'Smart / TNT',
            '0930': 'Smart / TNT',
            '0938': 'Smart / TNT',
            '0939': 'Smart / TNT',
            '0940': 'Smart / TNT',
            '0946': 'Smart / TNT',
            '0947': 'Smart / TNT',
            '0948': 'Smart / TNT',
            '0949': 'Smart / TNT',
            '0950': 'Smart / TNT',
            '0951': 'Smart / TNT',
            '0961': 'Smart / TNT',
            '0963': 'Smart / TNT',
            '0968': 'Smart / TNT',
            '0969': 'Smart / TNT',
            '0970': 'Smart / TNT',
            '0981': 'Smart / TNT',
            '0989': 'Smart / TNT',
            '0992': 'Smart / TNT',
            '0998': 'Smart / TNT',
            '0999': 'Smart / TNT',
            '0895': 'Dito',
            '0896': 'Dito',
            '0897': 'Dito',
            '0898': 'Dito',
            '0991': 'Dito',
            '0992': 'Dito',
            '0993': 'Dito',
            '0994': 'Dito',
            '0922': 'Sun Cellular',
            '0923': 'Sun Cellular',
            '0924': 'Sun Cellular',
            '0925': 'Sun Cellular',
            '0931': 'Sun Cellular',
            '0932': 'Sun Cellular',
            '0933': 'Sun Cellular',
            '0934': 'Sun Cellular',
            '0941': 'Sun Cellular',
            '0942': 'Sun Cellular',
            '0943': 'Sun Cellular',
            '0944': 'Sun Cellular'
        };

        let productPrice = 0.0;
        let productId = 1;

        let modeOfPayment = null;
        let order_subtotal = 0.0; // loaded
        let discountAmount = 0.0;
        let totalAmount = 0.0; // loaded

        window.addEventListener("load", () => {

            console.log("checkout.js loaded");
            window.openModal = function (event) {
                event.preventDefault(); // Prevent default anchor behavior
                document.getElementById('termsModal').classList.remove('hidden');
            }

            window.submitAgreement = function () {
                // tick the terms-checkbox
                document.getElementById('terms-checkbox').checked = true;
                // update place order button and cll the function
                updatePlaceOrder();

                // alert("Thank you for agreeing to the terms and conditions.");
                document.getElementById('termsModal').classList.add('hidden');
            }

            // document.getElementById('agree-checkbox').addEventListener('change', function() {
            //     document.getElementById('submit-btn').disabled = !this.checked;
            // });

            loadOrderItems();

            loadDropdown();

            updatePlaceOrder();

            // Get current time
            const currentTime = new Date();
            const currentHour = currentTime.getHours();
            const currentMinute = currentTime.getMinutes();
            const minTime = "15:30"; // 3:30 PM
            const maxTime = "22:30"; // 10:30 PM

            // Default time
            let defaultTime = "15:30"; // Initial default time

            // Calculate dynamic minTime based on current time
            let dynamicMinTime = "15:30"; // Default min time

            // If current time is out of the min-max range, set the default to 3:30
            if (currentHour < 15 || (currentHour === 15 && currentMinute < 30)) {
                defaultTime = "15:30";
                dynamicMinTime = "15:30"; // Set to 3:30 PM if current time is earlier
            } else if (currentHour >= 22 || (currentHour === 22 && currentMinute > 30)) {
                defaultTime = "15:30"; // Set to 3:30 PM if current time is past max
                dynamicMinTime = "15:30"; // Set to 3:30 PM if current time is past max
            } else {
                // If current time is between min and max time - 30 minutes, set default to 30 minutes ahead
                const thirtyMinutesAhead = new Date(currentTime.getTime() + 30 * 60000); // Add 30 minutes
                const formattedDefaultTime = formatTime(thirtyMinutesAhead);
                const formattedMinTime = formatTime(thirtyMinutesAhead);
                defaultTime = formattedDefaultTime;
                dynamicMinTime = formattedMinTime;
            }

            // Function to format time to h:i format
            function formatTime(date) {
                const hours = date.getHours();
                const minutes = date.getMinutes();
                const ampm = hours >= 12 ? 'PM' : 'AM';
                const formattedHours = hours % 12 || 12; // Convert 24-hour format to 12-hour
                const formattedMinutes = minutes < 10 ? '0' + minutes : minutes;
                return `${formattedHours}:${formattedMinutes} ${ampm}`;
            }

            flatpickr("#datepickerCheckout", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K", // 12-hour format with AM/PM
                minTime: dynamicMinTime, // Minimum time in 24-hour format (3:30 PM)
                maxTime: "22:30", // Maximum time in 24-hour format (10:30 PM)
                minuteIncrement: 1,
                defaultDate: defaultTime, // Dynamic default time
            });

            // <span id="dateDelivery" class=""></span>

            // Calculate delivery date based on current time
            const deliveryDate = calculateDeliveryDate(currentTime, minTime, maxTime);
            document.getElementById("dateDelivery").textContent = deliveryDate;

            let cnValidation = document.getElementById("cnValidation");
            let eaValidation = document.getElementById("eaValidation");

            document.querySelectorAll('.validate').forEach(field => {
                field.addEventListener('blur', function() {
                    if (field.value.trim() === "") {
                        field.classList.add('border-red-500'); // Add red border if empty
                        if (field.id === "contactNumber") {
                            cnValidation.classList.remove("hidden");
                        }
                        if (field.id === "email") {
                            eaValidation.classList.remove("hidden");
                        }
                        // Find the label associated with this input and add a red text color
                        const label = document.querySelector(`label[for="${field.id}"]`);
                        if (label) {
                            label.classList.add('text-red-500'); // Add red text color to label
                        }
                    } else {
                        field.classList.remove('border-red-500'); // Remove red border if valid
                        if (field.id === "contactNumber") {
                            cnValidation.classList.add("hidden");
                        }
                        if (field.id === "email") {
                            eaValidation.classList.add("hidden");
                        }
                        // Find the label associated with this input and remove red text color
                        const label = document.querySelector(`label[for="${field.id}"]`);
                        if (label) {
                            label.classList.remove(
                            'text-red-500'); // Remove red text color from label
                        }
                    }
                });
            });

            // Attach the event listener to the button
            placeOrderBtn.addEventListener("click", placeOrderBtnClick);
        });

        // Function to calculate delivery date
        function calculateDeliveryDate(currentTime, minTime, maxTime) {
            const currentHour = currentTime.getHours();
            const currentMinute = currentTime.getMinutes();
            const minHour = parseInt(minTime.split(":")[0]);
            const minMinute = parseInt(minTime.split(":")[1].split(" ")[0]);
            const maxHour = parseInt(maxTime.split(":")[0]);
            const maxMinute = parseInt(maxTime.split(":")[1].split(" ")[0]);

            // Check if current time is inside the range of min and max time
            if (currentHour < minHour || (currentHour === minHour && currentMinute < minMinute)) {
                return formatDate(currentTime); // If before min time, use today's date
            } else if (currentHour > maxHour || (currentHour === maxHour && currentMinute > maxMinute)) {
                // If after max time, set delivery date to tomorrow
                const tomorrow = new Date();
                tomorrow.setDate(currentTime.getDate() + 1);
                return formatDate(tomorrow);
            } else {
                // If within the range, set delivery date to today
                return formatDate(currentTime);
            }
        }

        // Function to format the date as "Feb 14 2025"
        function formatDate(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

        function loadOrderItems() {
            let totalPrice = 0;

            console.log("from order-now: ", orderItems);
            console.log("from order-now: ", orderNote);
            console.log("from order-now: ", orderSubtotal);

            if (savedOrders) {
                const parsedOrders = JSON.parse(savedOrders);
                for (const id in parsedOrders) {
                    if (parsedOrders.hasOwnProperty(id)) {
                        // Restore each item to the `orderItems` object
                        orderItems[id] = parsedOrders[id];

                        // Add the item back to the DOM
                        // addItemToOrderPanel(name, parsedOrders[name]);
                        addItemToReceipt(id, parsedOrders[id]);
                        totalPrice += parsedOrders[id].totalPrice;
                    }
                }

                console.log(orderItems);
            }

            updateTotal(totalPrice);
            cartCounter();
            updatePlaceOrder();
        }

        function addItemToReceipt(name, itemDetails) {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td class="px-6 py-4">
                    <div class="flex flex-col font-bold text-black">
                        <span class="font-medium text-gray-400">${itemDetails.category}</span>
                        <span>${itemDetails.name}</span>
                        <span class="font-medium text-gray-400">₱ ${itemDetails.price}</span>
                    </div>
                </td>
                <td class="py-4 pl-3 pr-1 text-center">${itemDetails.quantity}</td>
                <td class="py-4 pl-1 pr-5 font-bold text-black">₱ ${parseFloat(itemDetails.totalPrice).toFixed(2)}</td>
            `;
            document.querySelector("#orderItems").appendChild(row);
        }

        function updateTotal(price) {
            order_subtotal += price;
            totalAmount = order_subtotal + delivery_fee;

            document.getElementById("orderSubtotal").textContent = `₱ ${order_subtotal.toFixed(2)}`;
            document.getElementById("deliveryFee").textContent = `₱ ${delivery_fee.toFixed(2)}`;

            if (Object.keys(orderItems).length === 0) {
                document.getElementById("orderTotal").textContent = `₱ 0.00`;
                document.getElementById("footerOrderTotal").textContent = `₱ 0.00`;
            } else {
                document.getElementById("orderTotal").textContent = `₱ ${totalAmount.toFixed(2)}`;
                document.getElementById("footerOrderTotal").textContent = `₱ ${totalAmount.toFixed(2)}`;
            }
        }

        function cartCounter() {
            // Get the number of items in orderItems
            const numberOfItems = Object.keys(orderItems).length;

            basketCounterHTML.textContent = numberOfItems;
        }

        function loadDropdown() {
            const regionSelect = document.getElementById('region');
            const provinceSelect = document.getElementById('province');
            const municipalitySelect = document.getElementById('municipality');
            const barangaySelect = document.getElementById('barangay');

            provinceSelect.innerHTML = '<option value="">Select a province</option>';
            municipalitySelect.innerHTML = '<option value="">Select a municipality</option>';
            barangaySelect.innerHTML = '<option value="">Select a barangay</option>';
            provinceSelect.disabled = true;
            municipalitySelect.disabled = true;
            barangaySelect.disabled = true;

            // Fetch regions on page load
            fetch('https://psgc.gitlab.io/api/regions/')
                .then(response => response.json())
                .then(data => {
                    data.forEach(region => {
                        // remove if block to show all regions
                        // right now it is restricted to CALABARZON
                        if (region.code === '040000000') {
                            const option = document.createElement('option');
                            option.value = region.code;
                            option.setAttribute('data-rname', region
                            .name); // Store the region code as a custom data attribute
                            option.textContent = region.name;
                            regionSelect.appendChild(option);
                        }
                    });
                });

            // Fetch provinces when a region is selected
            regionSelect.addEventListener('change', () => {

                if (regionSelect.value) {
                    fetch(`https://psgc.gitlab.io/api/regions/${regionSelect.value}/provinces/`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(province => {
                                // remove if block to show all regions
                                // right now it is restricted to CALABARZON
                                if (province.code === '045800000') {
                                    const option = document.createElement('option');
                                    option.value = province.code;
                                    option.setAttribute('data-pname', province
                                    .name); // Store the region code as a custom data attribute
                                    option.textContent = province.name;
                                    provinceSelect.appendChild(option);
                                }
                            });
                            provinceSelect.disabled = false;
                        });
                }
            });

            // Fetch municipalities when a province is selected
            provinceSelect.addEventListener('change', () => {
                municipalitySelect.innerHTML = '<option value="">Select a municipality</option>';
                barangaySelect.innerHTML = '<option value="">Select a barangay</option>';
                municipalitySelect.disabled = true;
                barangaySelect.disabled = true;

                if (provinceSelect.value) {
                    fetch(`https://psgc.gitlab.io/api/provinces/${provinceSelect.value}/cities-municipalities/`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(city => {
                                // remove if block to show all regions
                                // right now it is restricted to CALABARZON
                                if (city.code === '045808000') {
                                    const option = document.createElement('option');
                                    option.value = city.code;
                                    option.setAttribute('data-cname', city.name);
                                    option.textContent = city.name;
                                    municipalitySelect.appendChild(option);
                                }
                            });
                            municipalitySelect.disabled = false;
                        });
                }
            });

            // Fetch barangays when a municipality is selected
            municipalitySelect.addEventListener('change', () => {
                barangaySelect.innerHTML = '<option value="">Select a barangay</option>';
                barangaySelect.disabled = true;

                if (municipalitySelect.value) {
                    fetch(`https://psgc.gitlab.io/api/cities-municipalities/${municipalitySelect.value}/barangays/`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(barangay => {
                                // remove if block to show all regions
                                // right now it is restricted to CALABARZON
                                if (barangay.code === '045808010' || barangay.code === '045808002') {
                                    const option = document.createElement('option');
                                    option.value = barangay.code;
                                    option.setAttribute('data-bname', barangay.name);
                                    option.textContent = barangay.name;
                                    barangaySelect.appendChild(option);
                                }
                            });
                            barangaySelect.disabled = false;
                        });
                }
            });
        };

        function updatePlaceOrder() {
            // Add an event listener to the checkbox
            termsCheckBox.addEventListener('change', function() {
                if (termsCheckBox.checked) {
                    placeOrderBtn.disabled = false;
                    placeOrderBtn.style.backgroundColor = "#066744";
                } else {
                    placeOrderBtn.disabled = true;
                    placeOrderBtn.style.backgroundColor = "rgb(156, 163, 175)"; // Gray equivalent to bg-gray-400
                }
            });

            if (termsCheckBox.checked) {
                    placeOrderBtn.disabled = false;
                placeOrderBtn.style.backgroundColor = "#066744";
            } else {
                placeOrderBtn.disabled = true;
                placeOrderBtn.style.backgroundColor = "rgb(156, 163, 175)"; // Gray equivalent to bg-gray-400
            }
        }

        function placeOrderBtnClick() {
            if (!validateContactDetails()) {
                // autto completion
                console.log("not validated");
                return;
            }

            // If all validations pass
            // parse the orders in object format
            let firstName = document.getElementById("firstName").value;
            let lastName = document.getElementById("lastName").value;
            let contactNumberelement = document.getElementById("contactNumber").value;
            let emailelement = document.getElementById("email").value;

            let regionElement = document.getElementById("region");
            let provinceElement = document.getElementById("province");
            let municipalityElement = document.getElementById("municipality");
            let barangayElement = document.getElementById("barangay");

            // Get the selected options and their data attributes
            let regionRName = regionElement.selectedOptions[0].getAttribute("data-rname");
            let provincePName = provinceElement.selectedOptions[0].getAttribute("data-pname");
            let municipalityMName = municipalityElement.selectedOptions[0].getAttribute("data-cname");
            let barangayBName = barangayElement.selectedOptions[0].getAttribute("data-bname");

            let street = document.getElementById("street").value;
            let unit = document.getElementById("unit").value;
            let addressType = document.querySelector('input[name="addressType"]:checked').value;
            let deliveryTime = document.getElementById("datepickerCheckout").value;
            let paymentType = document.querySelector('input[name="paymentMethod"]:checked').value;

            // Log the values of the elements
            console.log("Region:", regionElement.value);
            console.log("Province:", provinceElement.value);
            console.log("Municipality:", municipalityElement.value);
            console.log("Barangay:", barangayElement.value);

            const orderPayload = {
                customerDetails: {
                    firstName: firstName,
                    lastName: lastName,
                    contactNumber: contactNumberelement,
                    email: emailelement,
                },
                addressDetails: {
                    region: regionRName,
                    province: provincePName,
                    municipality: municipalityMName,
                    barangay: barangayBName,
                    street: street,
                    unit: unit,
                    addressType: addressType,
                },
                paymentDetails: {
                    paymentType: paymentType,
                    subtotal: order_subtotal,
                    deliveryFee: delivery_fee,
                    total: totalAmount,
                },
                orderDetails: {
                    items: orderItems, // Assuming `orderItems` is already an array of objects
                    deliveryTime: deliveryTime,
                    note: orderNote,
                },
            };

            console.log("orderPayload: ", orderPayload);

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log("csrfToken: ", csrfToken);
            const payUrl = "{{ route('pay') }}";
            console.log("payUrl: ", payUrl);


            // Send the data to the server
            fetch(payUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify(orderPayload),
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Failed to submit order');
                    }
                })
                .then(data => {
                    console.log('Order submitted successfully:', data);

                    // success();

                    setTimeout(() => {
                        // Redirect to menu page
                        window.location.href = data.redirect;
                    });
                })
                .catch(error => {
                    console.error('Error submitting order:', error);
                });
        }

        function validateContactDetails() {
            console.log('Validation started');

            let regionElement = document.getElementById("region").value;
            let provinceElement = document.getElementById("province").value;
            let municipalityElement = document.getElementById("municipality").value;
            let barangayElement = document.getElementById("barangay").value;
            let street = document.getElementById("street").value;
            let unit = document.getElementById("unit").value;

            let contactNumber = document.getElementById("contactNumber");
            let email = document.getElementById("email");

            let cnValidation = document.getElementById("cnValidation");
            let eaValidation = document.getElementById("eaValidation");

            let firstInvalidField = null;
            let validatedAll = true;

            // validate all fields if filled/valid input
            const fields = document.querySelectorAll(".validate"); // Select all fields with the validation class

            fields.forEach((field) => {
                if (!field.value.trim()) {
                    field.classList.add("border-red-500"); // Highlight the invalid field
                    if (!firstInvalidField) {
                        firstInvalidField = field; // Set the first invalid field
                    }
                    const label = document.querySelector(`label[for="${field.id}"]`);
                    if (label) {
                        label.classList.add('text-red-500'); // Add red text color to label
                    }
                } else {
                    field.classList.remove("border-red-500"); // Remove error highlight if valid
                    const label = document.querySelector(`label[for="${field.id}"]`);
                    if (label) {
                        label.classList.remove('text-red-500'); // Remove red text color from label
                    }
                }
                console.log('done validate fields');
            });

            if (firstInvalidField) {
                firstInvalidField.scrollIntoView({
                    behavior: "smooth",
                    block: "center"
                }); // Scroll to the invalid field
                firstInvalidField.focus(); // Optionally focus on the field
            }

            // Regular expressions
            let contactNumberRegex = /^(09|\+639)\d{9}$/; // For PH contact numbers
            let emailRegex = /^[^\s@]+@gmail\.com$/; // Only allow Gmail addresses

            // Validate contact number
            if (!contactNumberRegex.test(contactNumber.value.trim())) {
                validatedAll = false;
                console.log('done cn');
                cnValidation.classList.remove("hidden");
                // alert("Input Philippine phone number");
            }

            // Validate email
            if (!emailRegex.test(email.value.trim())) {
                validatedAll = false;
                console.log('done cn');
                eaValidation.classList.remove("hidden");
                // alert("Input valid gmail address");
            }

            //validate if their values present
            if (!regionElement || !provinceElement || !municipalityElement || !barangayElement || !street || !unit) {
                validatedAll = false;
                // alert("Please select a region, province, municipality, and barangay");
            }

            return validatedAll;
        }

        function parseOrders() {
            // get the data from the ui element
            subTotal = parseFloat(document.getElementById("sub-total").textContent.replace('₱ ', '').replace(',', ''));
            payableAmount = parseFloat(document.getElementById("payable-amount").textContent.replace('₱ ', '').replace(',',
                ''));
            const orderType = document.getElementById("order-type").value;

            // Transform orderItems into array of objects
            const transformedOrderItems = Object.entries(orderItems).map(([name, details]) => {
                return {
                    name: name,
                    quantity: details.quantity,
                    price: details.price
                };
            });

            // Prepare the data to send
            const payload = {
                orderItems: transformedOrderItems,
                orderType: orderType,
                discountType: discountType,
                discountAmount: discountAmount,
                subTotal: subTotal,
                payableAmount: payableAmount,
                modeOfPayment: modeOfPayment
            };

            // return the payload
            return payload;
        }
    </script>
</body>

</html>
