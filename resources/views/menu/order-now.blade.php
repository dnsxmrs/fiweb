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
                <button class="px-4 py-2 text-sm text-gray-700 rounded-md bg-brown-500 hover:bg-brown-600">
                    My account
                </button>
            </div>
        </div>
    </header>

    <!-- Menu header -->
    <div class="relative sticky z-10 h-40 bg-center bg-cover top-20"
        style="background-image: url('assets/coffee-shop-bg.png'); margin-bottom: 0;">
        <div class="absolute inset-0 flex flex-col items-center justify-center bg-black bg-opacity-30">
            <h1 class="text-5xl font-bold text-white">MENU</h1>
            <p class="mt-2 text-2xl font-light text-white">What are you craving today?</p>
        </div>
    </div>

    <!-- Tabs Section for Filtering -->
    <div class="sticky z-10 bg-white shadow-md top-60">
        <div class="flex justify-center py-4 space-x-4">
            <button onclick="filterProducts('all')"
                class="px-4 py-2 text-lg font-medium text-black border-b-2 border-black hover:text-black-800">
                All Menu
            </button>

            @foreach ($categories as $category)
                <button onclick="filterProducts('{{ $category->category_number }}')"
                    class="px-4 py-2 font-medium text-black text-lg hover:text-black-800">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    </div>

    <main class="container px-4 py-8 mx-auto">
        <!-- Grouped Products by Categories -->
        @foreach ($categories as $category)
            <section class="mb-12 category-section" data-category="{{ $category->category_number }}">
                <h3 class="mb-4 text-2xl font-semibold text-brown-700">{{ $category->name }}</h3>
                <div class="grid grid-cols-1 gap-x-5 gap-y-10 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
                    @foreach ($products as $product)
                        @if ($product->category_number === $category->category_number)
                            <!-- Product Cards -->
                            <div class="product-card mx-auto bg-white rounded-lg shadow-md w-70">
                                <!-- Product Image -->
                                <div class="p-4">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                        class="object-cover w-full rounded-lg h-44">
                                </div>
                                <!-- Product Name -->
                                <div class="text-center">
                                    <h4 class="mb-2 text-lg font-bold text-gray-800">{{ $product->name }}</h4>
                                </div>
                                <!-- Add to Bag Button -->
                                <button
                                    id="addToBagBtn"
                                    class="w-full text-sm py-2 text-white font-light bg-[#E9B303] hover:bg-[#C69702] rounded-b-lg transition"
                                    onclick="openModal('{{ $product->id }}')">
                                    Add to bag
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>
        @endforeach
    </main>

    <!-- Snacks/Dessert Modal -->
    <div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
        <div class="bg-[#E9B303] w-[455px] h-[590px] rounded-lg shadow-lg p-6">
            <div class="text-center">
                <!-- Header -->
                <h2 class="mb-4 text-2xl font-bold text-white">Customize your order</h2>

                <!-- Product Image -->
                <img
                    id="modalProductImage"
                    src=""
                    alt=""
                    class="mx-auto w-[350px] h-[200px] rounded-lg mb-4">

                <!-- Product Title -->
                <h3
                    id="modalProductTitle"
                    class="mb-2 text-2xl font-semibold text-white"></h3>
                <p
                    id="modalProductCategory"
                    class="mb-4 text-lg text-white"></p>

                <!-- Total Price -->
                <p id="modalProductPrice" class="mb-4 text-xl font-semibold text-white p"></p>

                <!-- Quantity Selector -->
                <div class="flex items-center justify-center pb-5 mb-6">
                    <button
                        id="decreaseBtn"
                        class="px-4 py-2 text-xl font-bold text-white bg-black rounded-full">-</button>
                    <span
                        id='quantity'
                        class="mx-6 text-xl text-white">1</span>
                    <button
                        id="increaseBtn"
                        class="px-4 py-2 text-xl font-bold text-white bg-black rounded-full">+</button>
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

        function openModal(productId) {
            // Make a fetch request to the server to get product data
            fetch(`/api/products/${productId}`)
                .then(response => response.json())  // Parse the JSON response
                .then(product => {
                    // Populate the modal with the product details
                    document.getElementById("modalProductImage").src = product.image;
                    document.getElementById("modalProductTitle").textContent = product.name;
                    document.getElementById("modalProductCategory").textContent = product.category_name;  // Use category_name
                    document.getElementById("modalProductPrice").textContent = "Php " + product.price;

                    // Set initial price
                    let quantity = 1;
                    let totalPrice = product.price;

                    // Update total price when quantity changes
                    const priceDisplay = document.getElementById("modalProductPrice");
                    const quantityDisplay = document.getElementById("quantity");

                    // Decrease Quantity
                    document.getElementById("decreaseBtn").addEventListener("click", () => {
                        if (quantity > 1) {
                            quantity--;
                            quantityDisplay.textContent = quantity;
                            priceDisplay.textContent = "Php " + (product.price * quantity).toFixed(2); // Update total price
                        }
                    });

                    // Increase Quantity
                    document.getElementById("increaseBtn").addEventListener("click", () => {
                        quantity++;
                        quantityDisplay.textContent = quantity;
                        priceDisplay.textContent = "Php " + (product.price * quantity).toFixed(2); // Update total price
                    });

                    // Show the modal
                    const modal = document.getElementById("modal");
                    modal.classList.remove("hidden");
                })
                .catch(error => {
                    console.error('Error fetching product data:', error);

                    // Optionally show a user-friendly message in case of an error
                    alert("There was an error loading the product data. Please try again.");
                });
        }

        // // Open Modal
        // addToBagBtn?.addEventListener("click", () => {
        //     modal.classList.remove("hidden");
        // });

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

        function filterProducts(categoryId) {
            const allSections = document.querySelectorAll('.category-section');

            allSections.forEach(section => {
                if (categoryId === 'all' || section.getAttribute('data-category') === categoryId) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        }
    </script>

</body>

</html>