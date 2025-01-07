// document
//     .getElementById("contactForm")
//     .addEventListener("submit", function (event) {
//         event.preventDefault(); // Prevent form submission

//         // Clear previous errors
//         document
//             .querySelectorAll(".error-message")
//             .forEach((el) => (el.textContent = ""));

//         // Form field values
//         const name = document.getElementById("name").value.trim();
//         const phone = document.getElementById("phone").value.trim();
//         const address = document.getElementById("address").value.trim();
//         const postalCode = document.getElementById("postalCode").value.trim();

//         let isValid = true;

//         // Validate Name
//         if (!name) {
//             isValid = false;
//             document.getElementById("nameError").textContent =
//                 "Name is required.";
//         }

//         // Validate Phone Number
//         const phoneRegex = /^[+]?[\d\s-]+$/; // Allows optional country code (+) and numbers
//         if (!phone || !phoneRegex.test(phone)) {
//             isValid = false;
//             document.getElementById("phoneError").textContent =
//                 "Please enter a valid phone number.";
//         }

//         // Validate Address
//         if (!address) {
//             isValid = false;
//             document.getElementById("addressError").textContent =
//                 "Address is required.";
//         }

//         // Validate Postal Code
//         const postalRegex = /^\d{4,6}$/; // Adjust regex based on country format
//         if (!postalCode || !postalRegex.test(postalCode)) {
//             isValid = false;
//             document.getElementById("postalCodeError").textContent =
//                 "Please enter a valid postal code.";
//         }

//         if (isValid) {
//             // Submit the form via AJAX or proceed to the next step
//             console.log("Form submitted successfully!");
//             alert("Contact details saved.");
//         }
//     });
