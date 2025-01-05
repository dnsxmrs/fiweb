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
    <div class="bg-white w-[400px] h-[300px] rounded-lg shadow-lg flex flex-col items-center justify-center">
      <!-- Success Icon -->
      <div class="flex items-center justify-center">
        <img src="assets/success 1.png" class="w-[70px] h-[70px]">
      </div>

      <!-- Payment Success Message -->
      <p class="mt-5 text-lg font-medium text-gray-800">Successful Payment!</p>
    </div>
  </div>

</body>
</html>
