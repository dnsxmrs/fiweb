<!-- Hot Drinks Modal -->
<div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-[#E9B303] w-[450px] h-[810px] rounded-lg shadow-lg p-6">
        <div class="text-center">
            <!-- Header -->
            <h2 class="mb-4 text-2xl font-bold text-white">Customize your order</h2>

            <!-- Product Image -->
            <img src="assets/Iced_Americano.png" alt="Americano" class="mx-auto w-[350px] h-[200px] rounded-lg mb-4">

            <!-- Product Title -->
            <h3 class="mb-2 text-xl font-semibold text-white">Americano</h3>
            <p class="mb-4 text-sm text-white">Hot Coffee</p>

            <!-- Drink Size Section -->
            <h4 class="mb-4 text-lg font-semibold text-white">Choose your drink size</h4>
            <div class="flex flex-col items-center mb-4">
                <div class="flex flex-col items-center bg-gray-200 rounded-lg shadow-md w-[100px] h-[140px]">
                    <img src="assets/coffee size.png" alt="8oz cup" class="w-12 h-12 mt-4">
                    <span class="mt-2 text-sm font-semibold text-gray-700">8oz</span>
                    <span class="text-sm text-gray-500">(Php 95.00)</span>
                </div>
            </div>

            <!-- Total Price -->
            <p class="pb-5 mb-4 text-lg font-semibold text-white">Php 95.00</p>

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
