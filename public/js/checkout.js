const basketCounterHTML = document.getElementById("basketCounter");
const termsCheckBox = document.getElementById("terms-checkbox");
const placeOrderBtn = document.getElementById("placeOrderButton");

const savedOrders = sessionStorage.getItem("orderItems");
const orderNote = sessionStorage.getItem("orderNote");
const orderSubtotal = sessionStorage.getItem("orderSubtotal");
const orderTax = sessionStorage.getItem("taxAmount");

const orderItems = {}; // loaded
const currentProduct = {};
const delivery_fee = 50;
const tax = 0.12;
const directTax = 1.12;

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
let taxAmount = 0.0;

window.addEventListener("load", () => {
    console.log("checkout.js loaded");

    loadOrderItems();

    loadDropdown();

    updatePlaceOrder();

    flatpickr("#datepickerCheckout", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // 12-hour format with AM/PM
        minTime: "15:00", // Minimum time in 24-hour format (3 PM)
        maxTime: "23:00", // Maximum time in 24-hour format (11 PM)
        minuteIncrement: 1,
        defaultDate: "15:00",
    });

    document.querySelectorAll('.validate').forEach(field => {
        field.addEventListener('blur', function () {
            if (field.value.trim() === "") {
                field.classList.add('border-red-500'); // Add red border if empty

                // Find the label associated with this input and add a red text color
                const label = document.querySelector(`label[for="${field.id}"]`);
                if (label) {
                    label.classList.add('text-red-500'); // Add red text color to label
                }
            } else {
                field.classList.remove('border-red-500'); // Remove red border if valid

                // Find the label associated with this input and remove red text color
                const label = document.querySelector(`label[for="${field.id}"]`);
                if (label) {
                    label.classList.remove('text-red-500'); // Remove red text color from label
                }
            }
        });
    });

    // Attach the event listener to the button
    placeOrderBtn.addEventListener("click", placeOrderBtnClick);
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
                    option.setAttribute('data-rname', region.name); // Store the region code as a custom data attribute
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
                            option.setAttribute('data-pname', province.name); // Store the region code as a custom data attribute
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
                        if (barangay.code === '045808010' || barangay.code === '045808002'){
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

function placeOrderBtnClick() {
    // validate all fields if filled/valid input
    const fields = document.querySelectorAll(".validate"); // Select all fields with the validation class
    let firstInvalidField = null;

    fields.forEach((field) => {
        if (!field.value.trim()) {
            field.classList.add("border-red-500"); // Highlight the invalid field
            if (!firstInvalidField) {
                firstInvalidField = field; // Set the first invalid field
            }
            const label = document.querySelector(`label[for="${field.id}"]`);
            console.log("label: ", label);
            if (label) {
                console.log("found: ", label);
                label.classList.add('text-red-500'); // Add red text color to label
            }
        } else {
            field.classList.remove("border-red-500"); // Remove error highlight if valid
            const label = document.querySelector(`label[for="${field.id}"]`);
            if (label) {
                label.classList.remove('text-red-500'); // Remove red text color from label
            }
        }
    });

    if (firstInvalidField) {
        firstInvalidField.scrollIntoView({ behavior: "smooth", block: "center" }); // Scroll to the invalid field
        firstInvalidField.focus(); // Optionally focus on the field
    } else {
        // Submit the form or proceed with the order placement
        // document.getElementById("orderForm").submit();
    }

    // parse the orders in object format
    let firstName = document.getElementById("firstName").value;
    let lastName = document.getElementById("lastName").value;
    let contactNumber = document.getElementById("contactNumber").value;
    let email = document.getElementById("email").value;

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

    const orderPayload = {
        customerDetails: {
            firstName: firstName,
            lastName: lastName,
            contactNumber: contactNumber,
            email: email,
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
            tax: taxAmount,
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
    fetch("/payment", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify(orderPayload),
    })
    .then(response => response.text()) // Parse as text first
    .then(rawData => {
        console.log('Raw server response:', rawData);

        // Attempt to parse JSON
        const data = JSON.parse(rawData);
        console.log('Parsed JSON:', data);

        // Handle success
        window.location.href = data.redirect;
    })
    .catch(error => {
        console.error('Error submitting order:', error);
    });


    // .then(response => {
    //     if (response.ok) {
    //         console.log('Order submitted successfully');
    //         return response.json();
    //     } else {
    //         console.error('Failed to submit order');
    //         // throw new Error('Failed to submit order');
    //     }
    // })
    // .then(data => {
    //     console.log('Order submitted successfully:', data);

    //     // success();

    //     setTimeout(() => {
    //         // Redirect to menu page
    //         window.location.href = data.redirect;
    //     });

    // })
    // .catch(error => {
    //     console.error('Error submitting order:', error);
    // });

//     // Call your server to create a payment session with PayMongo
//     fetch('/payment', {
//         method: 'POST',
//         body: JSON.stringify({ paymentMethod: paymentMethod.value, amount: 1000 }), // Pass amount dynamically
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': '{{ csrf_token() }}',
//         }
//     })
//     .then(response => response.json())
//     .then(data => {
//         // Assuming PayMongo returns a URL for redirection
//         const paymentUrl = data.paymentUrl;
//         if (paymentUrl) {
//             window.location.href = paymentUrl; // Redirect to PayMongo's payment page
//         } else {
//             alert("Error generating payment link.");
//         }
//     })
//     .catch(error => {
//         console.error('Error creating payment session:', error);
//         alert("Something went wrong. Please try again.");
//     });
};



function validateContactDetails() {
    // get value
    let firstName = document.getElementById("firstName").value;
    let lastName = document.getElementById("lastName").value;
    let contactNumber = document.getElementById("contactNumber").value;
    let email = document.getElementById("email").value;

    regex = '^(09|\\+639)\\d{9}$'

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
        taxAmount: taxAmount,
        discountType: discountType,
        discountAmount: discountAmount,
        subTotal: subTotal,
        payableAmount: payableAmount,
        modeOfPayment: modeOfPayment
    };

    // return the payload
    return payload;
}

// i should have functions for pushing ui with validation errors


