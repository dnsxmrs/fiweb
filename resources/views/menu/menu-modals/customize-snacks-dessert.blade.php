<!-- Snacks/Dessert Modal -->
<div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-[#E9B303] w-[455px] h-[590px] rounded-lg shadow-lg p-6">
        <div class="text-center">
            <!-- Header -->
            <h2 class="mb-4 text-2xl font-bold text-white">Customize your order</h2>

            <!-- Product Image -->
            <img src="assets/Iced_Americano.png" alt="Americano" class="mx-auto w-[350px] h-[200px] rounded-lg mb-4">

            <!-- Product Title -->
            <h3 class="mb-2 text-2xl font-semibold text-white">Fries</h3>
            <p class="mb-4 text-lg text-white">Snack</p>

            <!-- Total Price -->
            <p class="mb-4 text-xl font-semibold text-white p">Php 75.00</p>

            <!-- Quantity Selector -->
            <div class="flex items-center justify-center pb-5 mb-6">
                <button class="px-4 py-2 text-xl font-bold text-white bg-black rounded-full">-</button>
                <span class="mx-6 text-xl text-white">1</span>
                <button class="px-4 py-2 text-xl font-bold text-white bg-black rounded-full">+</button>
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

// Open Modal
addToBagBtn?.addEventListener("click", () => {
    modal.classList.remove("hidden");
});

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
</script>