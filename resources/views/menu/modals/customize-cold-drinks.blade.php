<!-- Cold Drinks Modal -->
<div id="modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50">
    <div class="bg-[#E9B303] w-[450px] h-[810px] rounded-lg shadow-lg p-6">
        <div class="text-center">
            <!-- Header -->
            <h2 class="mb-4 text-2xl font-bold text-white">Customize your order</h2>

            <!-- Product Image -->
            <img src="assets/Iced_Americano.png" alt="Americano" class="mx-auto w-[378px] h-[243px] rounded-lg mb-4">

            <!-- Product Title -->
            <h3 class="mb-2 text-3xl font-semibold text-white">Americano</h3>
            <p class="mb-6 text-lg text-white">Iced Coffee</p>

            <!-- Quantity Selector -->
            <div class="flex items-center justify-center mb-6">
                <button class="px-4 py-2 text-2xl font-bold text-white bg-black rounded-full">-</button>
                <span class="mx-6 text-2xl text-white">2</span>
                <button class="px-4 py-2 text-2xl font-bold text-white bg-black rounded-full">+</button>
            </div>

            <!-- Size Options -->
            <h4 class="mb-4 text-lg font-semibold text-white">Choose your drink size</h4>
            <div class="flex justify-center gap-4 mb-6">
                <!-- Size Option 1 -->
                <button
                    class="flex flex-col items-center justify-center w-24 h-32 bg-gray-200 rounded-lg shadow-md hover:bg-white hover:shadow-lg">
                    <img src="assets/coffee size.png" alt="16oz cup" class="w-12 h-12 mb-2">
                    <span class="text-sm font-semibold text-gray-500 hover:text-[#E9B303]">16oz</span>
                    <span class="text-sm text-gray-400 hover:text-gray-500">(Php 110.00)</span>
                </button>

                <!-- Size Option 2 -->
                <button
                    class="flex flex-col items-center justify-center w-24 h-32 bg-gray-200 rounded-lg shadow-md hover:bg-white hover:shadow-lg">
                    <img src="assets/coffee size.png" alt="16oz cup" class="w-12 h-12 mb-2">
                    <span class="text-sm font-semibold text-gray-500 hover:text-[#E9B303]">22oz</span>
                    <span class="text-sm text-gray-400 hover:text-gray-500">(Php 120.00)</span>
                </button>
            </div>
            <!-- Add to Bag Button -->
            <button id="closeModalBtn" class="py-3 text-lg font-semibold text-white bg-black w-[378px] rounded-3xl">
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
    addToBagBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
    });

    // Close Modal
    closeModalBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    // Close modal on clicking outside the content
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.add("hidden");
        }
    });
</script>
