const basketCounterHTML = document.getElementById("basketCounter");
const termsCheckBox = document.getElementById("terms-checkbox");
const placeOrderBtn = document.getElementById("placeOrder");

const savedOrders = sessionStorage.getItem("orderItems");
const orderNote = sessionStorage.getItem("orderNote");
const orderSubtotal = sessionStorage.getItem("orderSubtotal");
const orderTax = sessionStorage.getItem("taxAmount");

const orderItems = {}; // loaded
const currentProduct = {};
const delivery_fee = 50;
const tax = 0.12;
const directTax = 1.12;

let productPrice = 0.0;
let productId = 1;

let modeOfPayment = null;
let order_subtotal = 0.0; // loaded
let discountAmount = 0.0;
let totalAmount = 0.0; // loaded
let taxAmount = 0.0;

window.addEventListener("load", () => {
    console.log("checkout.js loaded");

    loadOrderItems();

    loadDropdown();

    updatePlaceOrder();

    flatpickr("#datepicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // 12-hour format with AM/PM
        minTime: "15:00", // Minimum time in 24-hour format (3 PM)
        maxTime: "23:00", // Maximum time in 24-hour format (11 PM)
        minuteIncrement: 1,
        defaultDate: "15:00",
    });
});

function loadOrderItems() {
    let totalPrice = 0;

    console.log("from order-now: ", orderItems);
    console.log("from order-now: ", orderNote);
    console.log("from order-now: ", orderSubtotal);
    console.log("from order-now: ", orderTax);

    if (savedOrders) {
        const parsedOrders = JSON.parse(savedOrders);
        for (const name in parsedOrders) {
            if (parsedOrders.hasOwnProperty(name)) {
                // Restore each item to the `orderItems` object
                orderItems[name] = parsedOrders[name];

                // Add the item back to the DOM
                // addItemToOrderPanel(name, parsedOrders[name]);
                addItemToReceipt(name, parsedOrders[name]);
                totalPrice += parsedOrders[name].totalPrice;
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
                <span>${name}</span>
                <span class="font-medium text-gray-400">₱ ${itemDetails.price}</span>
            </div>
        </td>
        <td class="pl-3 pr-1 py-4 text-center">${itemDetails.quantity}</td>
        <td class="pl-1 pr-5 py-4 font-bold text-black">₱ ${parseFloat(itemDetails.totalPrice).toFixed(2)}</td>
    `;
    document.querySelector("#orderItems").appendChild(row);
}

function updateTotal(price) {
    order_subtotal += price;
    taxAmount = parseFloat(order_subtotal * tax);
    totalAmount = order_subtotal + taxAmount;
    totalAmount += delivery_fee

    document.getElementById("orderSubtotal").textContent = `₱ ${order_subtotal.toFixed(2)}`;
    document.getElementById("deliveryFee").textContent = `₱ ${delivery_fee.toFixed(2)}`;
    document.getElementById("orderTax").textContent = `₱ ${taxAmount.toFixed(2)}`;

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
                if (region.code === '040000000'){
                    const option = document.createElement('option');
                    option.value = region.code;
                    // option.textContent = region.regionName + ' ' + region.name;
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
                        if (province.code === '045800000'){
                            const option = document.createElement('option');
                            option.value = province.code;
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
                        if (city.code === '045808000'){
                            const option = document.createElement('option');
                            option.value = city.code;
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
                        if (barangay.code === '045808010' || barangay.code === '045808002'){
                            const option = document.createElement('option');
                            option.value = barangay.code;
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
    termsCheckBox.addEventListener('change', function () {
        if (termsCheckBox.checked) {
            placeOrderBtn.disabled = false;
            placeOrderBtn.style.backgroundColor = "#0FAF00";
        } else {
            placeOrderBtn.disabled = true;
            placeOrderBtn.style.backgroundColor = "rgb(156, 163, 175)"; // Gray equivalent to bg-gray-400
        }
    });
}
