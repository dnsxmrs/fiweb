// JavaScript to open/close modal
const modal = document.getElementById("modal");
const addToBagBtn = document.getElementById("addToBagBtn"); // Trigger button (replace/add multiple IDs if needed)
const closeModalBtn = document.getElementById("closeModalBtn");

// for computations
let constProductPrice = 0.0;
let constProductId = 1;
let modeOfPayment = null;

const orderItems = {};

// Initialize button state on page load
window.addEventListener("DOMContentLoaded", updateCheckoutButton, console.log("DOM fully loaded and parsed"));

window.filterProducts = function (categoryId) {
    const allSections = document.querySelectorAll(".category-section");

    console.log("filter tab is clicked " + categoryId);

    allSections.forEach((section) => {
        if (
            categoryId === "all" ||
            section.getAttribute("data-category") === categoryId
        ) {
            section.style.display = "block";
        } else {
            section.style.display = "none";
        }
    });
};

window.searchProducts = function () {
    const searchInput = document.getElementById("searchInput");
    const searchValue = searchInput.value.toLowerCase().trim(); // Get the search value and trim extra spaces
    const allSections = document.querySelectorAll(".category-section");
    const searchHeader = document.querySelector(".search-header"); // Updated to target the h3 inside .search-header

    console.log("search input: " + searchInput);
    console.log("search value: " + searchValue);
    console.log("all sections: " + allSections);
    console.log("search header: " + searchHeader);

    let totalResults = 0; // Variable to store the total number of results found
    let sectionHasVisibleProduct = false; // Track if at least one product in the section matches
    let sectionProductCount = 0; // Track how many products match in this section

    // Loop through all category sections
    allSections.forEach((section) => {
        sectionHasVisibleProduct = false;
        const products = section.querySelectorAll(".product-card");
        console.log("products: " + products);
        products.forEach((product) => {
            const productName = product.getAttribute("data-name").toLowerCase(); // Accessing the data-name attribute

            // If the product name includes the search term, show it
            if (productName.includes(searchValue)) {
                product.style.display = "block";
                sectionProductCount++; // Increment count for matching products in this section
                sectionHasVisibleProduct = true; // Set this to true if this product is visible
            } else {
                product.style.display = "none"; // Hide the product if it doesn't match
            }
        });

        // If no products match, hide the entire section; otherwise, show the section
        if (sectionHasVisibleProduct) {
            console.log("section has visible product");
            section.style.display = "block"; // Show the section if at least one product matches
        } else {
            section.style.display = "none"; // Hide the section if no products match
        }
    });

    // Update the section heading dynamically based on search results
    console.log(searchHeader, sectionProductCount);
    if (searchHeader) {
        searchHeader.classList.remove("hidden"); // Show the search header

        if (sectionProductCount > 0) {
            searchHeader.textContent = `Search results for "${searchValue}" (${sectionProductCount} found)`;
            totalResults += sectionProductCount; // Update total results count
        } else {
            searchHeader.textContent = `No results found for "${searchValue}"`;
        }
    }
};

window.deleteNote = function () {
    const orderNoteElement = document.getElementById("orderNote"); // Use the correct ID as a string
    if (orderNoteElement) {
        orderNoteElement.value = ""; // Clear the value if the element exists
    } else {
        console.error("Element with ID 'orderNote' not found.");
    }
};



// Store the initial visibility state of the sections and products
const initialState = {
    sections: Array.from(document.querySelectorAll(".category-section")),
    products: Array.from(document.querySelectorAll(".product-card")),
};

// all about visibility of cards when searching, also taken care of behavior of search input/bar
window.addEventListener("load", function () {
    const searchInput = document.getElementById("searchInput");
    const searchButton = document.getElementById("searchButton");

    if (searchButton && searchInput) {
        searchButton.addEventListener("click", function () {
            searchInput.focus();
        });
    }

    // Search input event listener
    searchInput.addEventListener("input", function () {
        // Your logic here
        if (searchInput.value.length === 0) {
            document.querySelector(".search-header").classList.add("hidden");
        }
    });

    // // if the search input is lost focus
    // searchInput.addEventListener("blur", function () {
    //     // Reset the search input value
    //     this.value = "";
    //     // Reset the display state to the initial state
    //     initialState.sections.forEach((section, index) => {
    //         section.style.display = "block";
    //         const products = section.querySelectorAll(".product-card");
    //         products.forEach((product, i) => {product.style.display = "block";});
    //     });
    //     // Reset the search results header
    //     document.querySelector(".search-header").classList.add("hidden");
    // });
});

// Open Modal
window.openModal = function (data) {
    console.table(data);

    // Set initial price
    let quantity = 1;
    let totalPrice = data.product.price;
    constProductPrice = data.product.price;
    constProductId = data.product.id;

    console.log(totalPrice, quantity);

    const modal = document.getElementById("modal");
    // Update total price when quantity changes
    const priceDisplay = document.getElementById("modalProductPrice");
    const quantityDisplay = document.getElementById("quantity");

    // Populate the modal with the product details
    document.getElementById("modalProductImage").src = data.product.id;
    document.getElementById("modalProductImage").src = data.product.image;
    document.getElementById("modalProductTitle").textContent =
        data.product.name;
    document.getElementById("modalProductCategory").textContent =
        data.category.name;
    document.getElementById("modalProductPrice").textContent =
        "Php " + data.product.price;
    document.getElementById("quantity").textContent = quantity;

    // Decrease Quantity
    document.getElementById("decreaseBtn").addEventListener("click", () => {
        if (quantity > 1) {
            quantity--;
            quantityDisplay.textContent = quantity;
            priceDisplay.textContent =
                "Php " + (data.product.price * quantity).toFixed(2); // Update total price
        }
    });

    // Increase Quantity
    document.getElementById("increaseBtn").addEventListener("click", () => {
        if (quantity < 30) {
            quantity++;
            quantityDisplay.textContent = quantity;
            priceDisplay.textContent =
                "Php " + (data.product.price * quantity).toFixed(2); // Update total price
        }
    });

    // Show the modal
    modal.classList.remove("hidden");
};

// // for computations
// let order_subtotal = 0.0;
// const orderItems = {};
// const tax = 0.12;
// const delivery_fee = 50;
// let discountAmount = 0.0;
// let modeOfPayment = null;
// let constProductPrice = 0.0;
// let constProductId = 1;

window.addEventListener("load", () => {
    closeModalBtn?.addEventListener("click", () => {
        const category = document.getElementById("modalProductCategory").textContent;
        const name =document.getElementById("modalProductTitle").textContent;
        const quantity = parseInt(document.getElementById("quantity").textContent);
        const totalPrice = parseFloat(document.getElementById("modalProductPrice").textContent.split("Php ")[1]);

        console.table({ category, name, totalPrice, quantity});

        if (orderItems[name]) {
            // If item already exists, update the quantity and price
            orderItems[name].quantity += quantity;
            orderItems[name].totalPrice += totalPrice;

            // Update the quantity and price in the DOM
            const itemRow = document.getElementById("item-" + name);
            itemRow.querySelector(".cart-product-quantity").textContent = orderItems[name].quantity;
            itemRow.querySelector(".cart-quantity-price").textContent = `₱ ${orderItems[name].totalPrice.toFixed(2)}`;
        } else {
            // If item does not exist, add it to the order
            orderItems[name] = {
                quantity: quantity,
                totalPrice: totalPrice,
            };

            // Add the item to the right panel
            const orderItem = `
                    <div id="item-${name}" class="flex items-center justify-between py-3 border-b">
                        <!-- Item Details -->
                        <div class="flex items-center">
                            <div>
                                <p class="cart-product-name font-medium text-gray-800">${name}</p>
                                <p class="cart-product-price text-sm text-gray-500">₱ ${(parseFloat(constProductPrice) || 0).toFixed(2)}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <button onclick="changeQuantity('${name}', -1)" id="cart-decrease" class="cart-decrease px-2 py-1 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">-</button>
                            <span class="cart-product-quantity px-2 text-gray-800">${orderItems[name].quantity}</span>
                            <button onclick="changeQuantity('${name}', 1)" id="cart-increase" class="cart-increase px-2 py-1 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">+</button>
                        </div>

                        <div class="flex items-center">
                            <p class="cart-quantity-price font-medium text-gray-800">₱ ${orderItems[name].totalPrice.toFixed(2)}</p>
                        </div>
                    </div>
                `;

            // Append the new item to the order list
            document
                .getElementById("order-cart")
                .insertAdjacentHTML("beforeend", orderItem);
        }

        updateTotal(totalPrice);

        cartCounter();
        updateCheckoutButton();
    });
});

let order_subtotal = 0.0;
let discountAmount = 0.0;
let totalAmount = 0.0;

const tax = 0.12;
const delivery_fee = 50;


window.updateTotal = function (price) {
    order_subtotal += price;
    totalAmount = order_subtotal + delivery_fee;

    document.getElementById("orderSubtotal").textContent = `₱ ${order_subtotal.toFixed(2)}`;
    document.getElementById("deliveryFee").textContent = `₱ ${delivery_fee.toFixed(2)}`;

    if (Object.keys(orderItems).length === 0) {
        document.getElementById("orderTotal").textContent = `₱ 0.00`;
    } else {
        document.getElementById("orderTotal").textContent = `₱ ${totalAmount.toFixed(2)}`;
    }
}

window.changeQuantity = function (name, change) {
    if (orderItems[name]) {
        const productPrice = orderItems[name].totalPrice / orderItems[name].quantity; // Price per item

        if (change < 0 && orderItems[name].quantity === 1) {
            // If the quantity is already 1, do not allow to decrease below 0, remove item instead
            removeItem(name);

            updateTotal(-productPrice);
        } else {
            orderItems[name].quantity += change;

            // Update price after quantity change
            orderItems[name].totalPrice = productPrice * orderItems[name].quantity;

            // Update the quantity and price in the DOM
            const itemRow = document.getElementById("item-" + name);
            itemRow.querySelector(".cart-product-quantity").textContent = orderItems[name].quantity;
            itemRow.querySelector(".cart-quantity-price").textContent = `₱ ${orderItems[name].totalPrice.toFixed(2)}`;

            // Update the total after the change
            updateTotal(change * productPrice);
        }
    }

    updateCheckoutButton();
}



const basketCounterHTML = document.getElementById("basketCounter");

window.cartCounter = function () {
    // Get the number of items in orderItems
    const numberOfItems = Object.keys(orderItems).length;
    console.log(numberOfItems);
    console.log(orderItems);

    basketCounterHTML.textContent = numberOfItems;
}

function removeItem(name) {
    if (orderItems[name]) {
        // const pricePerItem = orderItems[name].price / orderItems[name].quantity;
        // subTotal -= orderItems[name].price; // Subtract the full price of the item from the total
        // payableAmount = subTotal - discountAmount + taxAmount; // Update global payableAmount
        delete orderItems[name];

        // document.getElementById(
        //     "sub-total"
        // ).textContent = `₱ ${subTotal.toFixed(2)}`;
        // document.getElementById(
        //     "payable-amount"
        // ).textContent = `₱ ${payableAmount.toFixed(2)}`;
        document.getElementById("item-" + name).remove();

        // // If no items are left, reset totals
        // if (Object.keys(orderItems).length === 0) {
        //     resetOrder();
        // } else {
        //     // Update the total after removal
        //     updateTotal(-orderItems[name].price); // Ensure total isn't negative
        // }

        cartCounter();
    }
}

// // Close Modal
// closeModalBtn?.addEventListener("click", () => {
//     // get the category, product name, prodct price, quantity, quantity-price from modal
//     let category = document.getElementById("modalProductCategory").textContent;
//     let productName = document.getElementById("modalProductTitle").textContent;
//     let productPrice = parseFloat(
//         document.getElementById("modalProductPrice").textContent.split("Php ")[1]
//     );
//     let quantity = parseInt(document.getElementById("quantity").textContent);
//     let totalPrice = parseFloat(
//         document.getElementById("modalProductPrice").textContent.split("Php ")[1]
//     );

//     if (orderItems[productName]) {
//         orderItems[name].quantity++;
//         orderItems[name].price += price;

//         // Update the quantity and price in the DOM
//         const itemRow = document.getElementById("item-" + name);
//         itemRow.querySelector(".item-qty").textContent =
//             orderItems[name].quantity;
//         itemRow.querySelector(".item-price").textContent = `₱ ${orderItems[
//             name
//         ].price.toFixed(2)}`;
//     } else {
//         // If item does not exist, add it to the order
//         orderItems[name] = {
//             quantity: 1,
//             price: price,
//         };

//         // Add the item to the right panel
//         const orderItem = `
//                     <div class="flex items-center justify-between py-3 border-b">
//                         <!-- Item Details -->
//                         <div class="flex items-center">
//                             <div>
//                                 <p class="cart-product-name font-medium text-gray-800"></p>
//                                 <p class="cart-product-price text-sm text-gray-500"></p>
//                             </div>
//                         </div>

//                         <div class="flex items-center">
//                             <button class="cart-decrease px-2 py-1 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">-</button>
//                             <span class="cart-product-quantity px-4 text-gray-800"></span>
//                             <button class="cart-increase px-2 py-1 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">+</button>
//                         </div>

//                         <div class="flex items-center">
//                             <p class="cart-quantity-price mr-4 font-medium text-gray-800"></p>
//                         </div>
//                     </div>
//                 `;

//         // Append the new item to the order list
//         document
//             .getElementById("order-items-container")
//             .insertAdjacentHTML("beforeend", orderItem);
//     }

//     console.table({
//         category,
//         productName,
//         productPrice,
//         quantity,
//         totalPrice,
//     });

//     const orderCartContainer = document.getElementById("order-cart");
//     const subtotal = document.getElementById("order-subtotal");
//     const orderTotal = document.getElementById("order-total");

//     orderCartContainer.innerHTML = "";

//     Object.keys(orderItems).forEach((name) => {
//         const item = orderItems[name];
//         const itemRow = `
//         <div class="flex justify-between text-sm text-gray-600 mb-2">
//             <span>${item.quantity}   ${name}</span>
//             <span>₱ ${item.price.toFixed(2)}</span>
//         </div>`;
//         orderCartContainer.insertAdjacentHTML("beforeend", itemRow);
//     });

//     // // Add product to cart
//     // addToCart({
//     //     category,
//     //     productName,
//     //     productPrice,
//     //     quantity,
//     //     totalPrice,
//     // });

//     modal.classList.add("hidden");
// });

// Close modal on clicking outside the content
modal.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.classList.add("hidden");
    }
});

window.checkout = function () {
    localStorage.setItem("orderItems", JSON.stringify(orderItems));

    // Redirect to the order summary page
    window.location.href = "/order/checkout";
}

const checkoutButton = document.getElementById("checkoutBtn");

function updateCheckoutButton() {
    // Check if orderItems is empty
    const hasItems = Object.keys(orderItems).length > 0;

    if (hasItems) {
        checkoutButton.disabled = false; // Enable the button
        checkoutButton.classList.remove("opacity-50", "cursor-not-allowed"); // Remove disabled styles
    } else {
        checkoutButton.disabled = true; // Disable the button
        checkoutButton.classList.add("opacity-50", "cursor-not-allowed"); // Add disabled styles
    }
}


