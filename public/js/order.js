// document.getElementById("addMoreItems").addEventListener("click", function () {
//     document.getElementById("editModal").style.display = "block";

//     const orderItems = document.querySelectorAll("#orderItems li");
//     const editList = document.getElementById("editOrderItems");
//     editList.innerHTML = "";

//     orderItems.forEach((item) => {
//         const listItem = document.createElement("li");
//         listItem.textContent = item.textContent;

//         // Add remove button
//         const removeButton = document.createElement("button");
//         removeButton.textContent = "Remove";
//         removeButton.addEventListener("click", () => listItem.remove());
//         listItem.appendChild(removeButton);

//         editList.appendChild(listItem);
//     });
// });

// document.getElementById("saveChanges").addEventListener("click", function () {
//     const editItems = document.querySelectorAll("#editOrderItems li");
//     const orderList = document.getElementById("orderItems");
//     orderList.innerHTML = "";

//     editItems.forEach((item) => {
//         const listItem = document.createElement("li");
//         listItem.textContent = item.textContent.split("Remove")[0].trim();
//         orderList.appendChild(listItem);
//     });

//     document.getElementById("editModal").style.display = "none";
//     updateTotal();
// });

// document.getElementById("closeModal").addEventListener("click", function () {
//     document.getElementById("editModal").style.display = "none";
// });
