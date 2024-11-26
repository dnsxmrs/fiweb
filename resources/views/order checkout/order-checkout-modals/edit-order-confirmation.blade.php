<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Modal</title>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">

  <!-- Modal Background -->
  <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <!-- Modal Content -->
    <div class="bg-white w-[600px] h-[400px] rounded-lg shadow-lg flex flex-col items-center justify-center">
      <!-- Modal Text -->
      <p class="mb-8 text-xl font-medium text-gray-800">Do you want to edit your order?</p>

      <!-- Edit Order Button -->
      <button class="w-[195px] h-[45px] mb-4 font-bold text-white transition bg-green-500 rounded-md hover:bg-green-600">
        Edit Order
      </button>

      <!-- Cancel Button -->
      <button class="w-[195px] h-[45px] font-bold text-red-500 transition border border-red-500 rounded-md hover:bg-red-500 hover:text-white">
        Cancel
      </button>
    </div>
  </div>

</body>
</html>
