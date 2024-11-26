document.querySelectorAll(".add-to-cart").forEach((button) => {
    button.addEventListener("click", () => {
        const productId = button.dataset.id;
        fetch(`/product/${productId}`)
            .then((response) => response.json())
            .then((product) => {
                addToCart(product);
            });
    });
});

function addToCart(product) {
    const cartItems = document.getElementById("cart-items");
    const listItem = document.createElement("li");
    listItem.textContent = `${product.product_name} - ₱${product.product_price}`;
    listItem.dataset.id = product.id;
    cartItems.appendChild(listItem);
    updateTotal();
}

function updateTotal() {
    const cartItems = document.querySelectorAll("#cart-items li");
    let total = 0;
    cartItems.forEach((item) => {
        total += parseFloat(item.textContent.split("₱")[1]);
    });
    document.getElementById(
        "total-price"
    ).textContent = `Total: ₱${total.toFixed(2)}`;
}
