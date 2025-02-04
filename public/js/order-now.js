// JavaScript to open/close modal

const modal = document.getElementById("modal");
const checkoutButton = document.getElementById("checkoutBtn");
const basketCounterHTML = document.getElementById("basketCounter");

const orderItems = {}; // loaded
const currentProduct = {};
const delivery_fee = 50;

let constProductPrice = 0.0;
let constProductId = 1;

let modeOfPayment = null;
let order_subtotal = 0.0; // loaded
let totalAmount = 0.0; // loaded

// Initialize button state on page load
window.addEventListener("load", () => {
    console.log("DOM fully loaded and parsed")

    loadOrdersFromLocalStorage();
});

function loadOrdersFromLocalStorage() {
    // change to local storage if want to load data even when tab is closed
    const savedOrders = sessionStorage.getItem("orderItems");
    let totalPrice = 0;
    if (savedOrders) {
        // Parse and restore the `orderItems` object
        const parsedOrders = JSON.parse(savedOrders);
        for (const id in parsedOrders) {
            if (parsedOrders.hasOwnProperty(id)) {
                // Restore each item to the `orderItems` object
                orderItems[id] = parsedOrders[id];

                // Add the item back to the DOM
                addItemToOrderPanel(id, parsedOrders[id]);
                totalPrice += parsedOrders[id].totalPrice;
            }
        }
    }

    updateTotal(totalPrice);
    cartCounter();
    updateCheckoutButton();
}

function addItemToOrderPanel(id, itemDetails) {
    const orderPanel = document.querySelector(".order-cart");
    const itemHTML = `
        <div id="item-${id}" class="flex items-center justify-between py-3 border-b">
            <div class="flex items-center">
                <div>
                    <p class="cart-product-price text-xs text-gray-500">${itemDetails.category}</p>
                    <p class="cart-product-name font-medium text-gray-800">${itemDetails.name}</p>
                    <p class="cart-product-price text-sm text-gray-500">₱ ${itemDetails.price.toFixed(2)}</p>
                </div>
            </div>

            <div class="flex items-center">
                <button onclick="changeQuantity('${id}', -1, this)" id="cart-decrease-${id}" class="cart-decrease px-2 py-1 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">-</button>
                <input type="input" id="cart-quantity-${id}" value="${itemDetails.quantity}" class="cart-product-quantity px-2 text-gray-800 w-8 text-center" min="1" max="30" onchange="updateQuantityFromInput('${id}', this)">
                <button onclick="changeQuantity('${id}', 1, this)" id="cart-increase-${id}" class="cart-increase px-2 py-1 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">+</button>
            </div>

            <div class="flex items-center">
                <p class="cart-quantity-price font-medium text-gray-800">₱ ${itemDetails.totalPrice.toFixed(2)}</p>
            </div>
        </div>
    `;
    orderPanel.insertAdjacentHTML("beforeend", itemHTML);

    const orderNote = sessionStorage.getItem("orderNote");
    if (orderNote) {
        document.getElementById("orderNote").value = orderNote;
    }
}

function updateTotal(price) {
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

function cartCounter() {
    // Get the number of items in orderItems
    const numberOfItems = Object.keys(orderItems).length;

    basketCounterHTML.textContent = numberOfItems;
}

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

// when a category tabs is cicked, the coresponding category is displayed
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

// Store the initial visibility state of the sections and products
const initialState = {
    sections: Array.from(document.querySelectorAll(".category-section")),
    products: Array.from(document.querySelectorAll(".product-card")),
};

// Search for products, categories, search headers
window.searchProducts = function () {
    const searchValue = document.getElementById("searchInput").value.toLowerCase().trim(); // Get the search value and trim extra spaces
    const allSections = document.querySelectorAll(".category-section"); // Get all category sections
    const searchHeader = document.getElementById("search-header"); // Updated to target the h3, the search results text
    const searchContent = document.getElementById("search-content");

    let sectionHasVisibleProduct = false; // Track if at least one product in the section matches
    let sectionProductCount = 0; // Track how many products match in this section

    // Loop through all category sections
    allSections.forEach((section) => {
        sectionHasVisibleProduct = false;
        const products = section.querySelectorAll(".product-card");

        products.forEach((product) => {
            const productName = product.getAttribute("data-name").toLowerCase(); // Accessing the data-name attribute

            // If the product name includes the search term, show it
            if (productName.includes(searchValue)) {
                product.style.display = "block"; // Display the product if it matches
                sectionProductCount++; // Increment count for matching products in this section
                sectionHasVisibleProduct = true; // Set this to true if this product is visible
            } else {
                product.style.display = "none"; // Hide the product if it doesn't match
            }
        });

        // If no products match, hide the entire section; otherwise, show the section
        if (sectionHasVisibleProduct) {
            section.style.display = "block"; // Show the section if at least one product matches
        } else {
            section.style.display = "none"; // Hide the section if no products match
        }
    });

    if (searchHeader) {
        searchHeader.classList.remove("hidden"); // Show the search header
        searchContent.classList.remove("hidden");
        if (sectionProductCount > 0) {
            searchContent.textContent = `Search results for "${searchValue}" (${sectionProductCount} found)`;
        } else {
            searchContent.textContent = `No results found for "${searchValue}"`;
        }
    }
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

// Open Modal, when pressed add to bag
window.openModal = function (data) {
    console.table(data);

    // Set initial price
    let quantity = 1;
    constProductPrice = parseFloat(data.product.price);
    constProductId = data.product.id;

    console.log("Product Price: " + constProductPrice);
    console.log("Product ID: " + constProductId);
    console.log("Quantity: " + quantity);

    // Update total price when quantity changes
    const priceDisplay = document.getElementById("modalProductPrice");
    const quantityDisplay = document.getElementById("quantity");
    const decreaseBtn = document.getElementById("decreaseBtn");
    const increaseBtn = document.getElementById("increaseBtn");

    // Populate the modal with the product details
    document.getElementById("modalProductId").textContent = data.product.id;
    document.getElementById("modalProductImage").src = data.product.image;
    document.getElementById("modalProductTitle").textContent = data.product.name;
    document.getElementById("modalProductCategory").textContent = data.category.name;
    priceDisplay.textContent = "Php " + constProductPrice;
    quantityDisplay.textContent = quantity;

    // Function to update the total price and button state
    const updatePriceAndState = () => {
        quantityDisplay.textContent = quantity;
        priceDisplay.textContent = "Php " + (constProductPrice * quantity).toFixed(2);

        // Disable buttons based on quantity
        decreaseBtn.disabled = quantity <= 1;
        increaseBtn.disabled = quantity >= 30;
        decreaseBtn.classList.toggle("opacity-50", quantity <= 1);
        increaseBtn.classList.toggle("opacity-50", quantity >= 30);
    };

        // Function to change the quantity (both decrease and increase)
    window.modalChangeQuantity = function (change) {
        quantity += change;
        updatePriceAndState();
    };

    // Initial price and button state update
    updatePriceAndState();

    currentProduct[data.product.id] = {
        id: constProductId,
        name: data.product.name,
        img: data.product.image,
        price: constProductPrice,

        category: data.category.name,
    };

    // Show the modal
    modal.classList.remove("hidden");
};

// Close Modal when clicked outside the content
modal.addEventListener("click", (e) => {
    if (e.target === modal) {
        modal.classList.add("hidden");
    }
});

//
window.addToMyBag = function () {
    // const productId = currentProduct[constProductId];

    const name = currentProduct[constProductId].name;
    // const name =document.getElementById("modalProductTitle").textContent;
    const quantity = parseInt(document.getElementById("quantity").textContent);
    const totalPrice = parseFloat(document.getElementById("modalProductPrice").textContent.split("Php ")[1]);

    console.table({constProductId, name, totalPrice, quantity});

    if (orderItems[constProductId]) {

        if (orderItems[constProductId].quantity >= 30 || orderItems[constProductId].quantity + quantity > 30) {
            modal.classList.add("hidden");
            return;
        }

        // If item already exists, update the quantity and price
        orderItems[constProductId].quantity += quantity;
        orderItems[constProductId].totalPrice += parseFloat(totalPrice);

        // Update the quantity and price in the DOM
        const itemRow = document.getElementById("item-" + constProductId);
        itemRow.querySelector(".cart-product-quantity").value = orderItems[constProductId].quantity;
        itemRow.querySelector(".cart-quantity-price").textContent = `₱ ${orderItems[constProductId].totalPrice.toFixed(2)}`;

    } else {

        // If item does not exist, add it to the order
        orderItems[constProductId] = {
            id: constProductId,
            name: name,
            img: currentProduct[constProductId].img,
            price: currentProduct[constProductId].price,
            quantity: quantity,
            totalPrice: totalPrice,

            category: currentProduct[constProductId].category
        };

        // Add the item to the right panel
        const orderItem = `
                <div id="item-${constProductId}" class="flex items-center justify-between py-3 border-b">
                    <!-- Item Details -->
                    <div class="flex items-center">
                        <div>
                            <p class="cart-product-price text-xs text-gray-500">${orderItems[constProductId].category}</p>
                            <p class="cart-product-name font-medium text-gray-800">${orderItems[constProductId].name}</p>
                            <p class="cart-product-price text-xs text-gray-500">₱ ${orderItems[constProductId].price.toFixed(2)}</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <button onclick="changeQuantity('${constProductId}', -1, this)" id="cart-decrease-${constProductId}" class="cart-decrease px-2 py-1 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">-</button>
                        <input type="input" id="cart-quantity-${constProductId}" value="${orderItems[constProductId].quantity}" class="cart-product-quantity px-2 text-gray-800 w-8 text-center" min="1" max="30" onchange="updateQuantityFromInput('${constProductId}', this)">
                        <button onclick="changeQuantity('${constProductId}', 1, this)" id="cart-increase-${constProductId}" class="cart-increase px-2 py-1 text-gray-600 bg-gray-200 rounded hover:bg-gray-300">+</button>
                    </div>

                    <div class="flex items-center">
                        <p class="cart-quantity-price font-medium text-gray-800">₱ ${orderItems[constProductId].totalPrice.toFixed(2)}</p>
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
    saveOrders();

    console.log("AFTER", orderItems)
    modal.classList.add("hidden");

};


window.deleteNote = function () {
    const orderNoteElement = document.getElementById("orderNote"); // Use the correct ID as a string
    if (orderNoteElement) {
        orderNoteElement.value = ""; // Clear the value if the element exists
    } else {
        console.error("Element with ID 'orderNote' not found.");
    }

    saveOrders();
};


window.changeQuantity = function (id, change, button) {
    
    console.log("outisde function");
    console.log("quantity: ", orderItems[id].quantity);

    if (orderItems[id]) {
        const productPrice = orderItems[id].totalPrice / orderItems[id].quantity; // Price per item
        const orderId = orderItems[id].id;

        if (change < 0 && orderItems[id].quantity === 1) {
            // If the quantity is already 1, do not allow to decrease below 0, remove item instead
            removeItem(id);
            updateTotal(-productPrice);
        } else {
            orderItems[id].quantity += change;

            // Update price after quantity change
            orderItems[id].totalPrice = parseFloat(productPrice * orderItems[id].quantity);

            // Update the quantity and price in the DOM
            const itemRow = document.getElementById("item-" + id);
            itemRow.querySelector(".cart-product-quantity").value = orderItems[id].quantity;
            itemRow.querySelector(".cart-quantity-price").textContent = `₱ ${orderItems[id].totalPrice.toFixed(2)}`;

            // Update the total after the change
            updateTotal(change * productPrice);
        }
    }

    updateQuantityButton(id, change);
    cartCounter();
    updateCheckoutButton();
    saveOrders();
};

function removeItem(id) {
    if (orderItems[id]) {
        delete orderItems[id];

        document.getElementById("item-" + id).remove();
    }
}

// New function to handle quantity changes from the input field
window.updateQuantityFromInput = function (id, input) {
    let newQuantity = parseInt(input.value);
    let productPrice = orderItems[id].totalPrice / orderItems[id].quantity; // Price per item
    let changeQuantity = newQuantity - orderItems[id].quantity;
    var change;

    if (newQuantity >= 1 && newQuantity <= 30) {
        orderItems[id].quantity = newQuantity;
        orderItems[id].totalPrice = parseFloat(productPrice * newQuantity);

        change = newQuantity;

        // set the input value to 30
        input.value = newQuantity;

        // Update the total price in the DOM
        let itemRow = document.getElementById("item-" + id);
        itemRow.querySelector(".cart-quantity-price").textContent = `₱ ${orderItems[id].totalPrice.toFixed(2)}`;

        // Update the quantity for the cart
        updateTotal(changeQuantity * productPrice);
    } else {
        const maxQuantity = 30;

        let changeQuantity = maxQuantity - orderItems[id].quantity;

        orderItems[id].quantity = maxQuantity;
        orderItems[id].totalPrice = parseFloat(productPrice * maxQuantity);

        change = maxQuantity;

        // set the input value to 30
        input.value = maxQuantity;

        // Update the total price in the DOM
        let itemRow = document.getElementById("item-" + id);
        itemRow.querySelector(".cart-quantity-price").textContent = `₱ ${orderItems[id].totalPrice.toFixed(2)}`;

        // Update the quantity for the cart
        updateTotal(changeQuantity * productPrice);
    }

    updateQuantityButton(id, change);
    cartCounter();
    updateCheckoutButton();
    saveOrders();
};

// update the increase and decrease buttons
function updateQuantityButton(id, change) {
    // Prevent increasing quantity beyond 30
    if (orderItems[id].quantity >= 30 && change > 0) {
        console.log("quantity is 30");
        // Disable the increase button and set opacity to 50%
        const increaseBtn = document.getElementById(`cart-increase-${id}`);
        increaseBtn.disabled = true;
        increaseBtn.classList.remove("opacity-100"); // Remove opacity-50 when opacity-100 is added
        increaseBtn.classList.add("opacity-50");
    }

    // Enable the increase button and set opacity to 100% if quantity is less than 30
    if (orderItems[id].quantity < 30) {
        console.log(" qunatity less than 30");
        const increaseBtn = document.getElementById(`cart-increase-${id}`);
        increaseBtn.disabled = false;
        increaseBtn.classList.remove("opacity-50"); // Remove opacity-50 when opacity-100 is added
        increaseBtn.classList.add("opacity-100");
    }
}


window.checkout = function () {
    // Store the order items in localStorage
    saveOrders();

    // Redirect to the order summary page
    window.location.href = "/checkout";
}

function saveOrders() {
    // CHANGE ALL TO LOCALSTORAGE IF YOU WANT TO STORE DATA EVEN WHEN TAB IS CLOSED
    // store the orderItems in localStorage for later retrieval
    sessionStorage.setItem("orderItems", JSON.stringify(orderItems));

    // store the orderNote in sessionStorage for later retrieval
    sessionStorage.setItem("orderNote", document.getElementById("orderNote").value);

    // store the orderSubtotal in sessionStorage for later retrieval
    sessionStorage.setItem("orderSubtotal", document.getElementById("orderSubtotal").textContent);

    console.log("Order items saved to localStorage");
}




const isLocalStorageEnabled = () => {
    try {
        const key = `__storage__test`;
        window.localStorage.setItem(key, null);
        window.localStorage.removeItem(key);
        return true;
    } catch (e) {
        return false;
    }
};

const isSessionStorageEnabled = () => {
    try {
        const key = `__storage__test`;
        window.sessionStorage.setItem(key, null);
        window.sessionStorage.removeItem(key);
        return true;
    } catch (e) {
        return false;
    }
};
