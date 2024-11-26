<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Order Cancellation</title>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">

  <!-- Modal Background -->
  <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <!-- Modal Content -->
    <div class="bg-white w-[500px] h-[450px] rounded-lg shadow-lg flex flex-col items-center p-6">

      <!-- Modal Text -->
      <p class="mb-6 text-xl font-medium text-gray-800">Please select a reason for canceling your order:</p>

      <!-- Radio Buttons for Cancellation Reasons -->
      <div class="w-full mb-6 space-y-4">
        <label class="flex items-center">
          <input type="radio" name="cancelReason" value="Change of mind" class="mr-2">
          Change of mind
        </label>
        <label class="flex items-center">
          <input type="radio" name="cancelReason" value="Incorrect order" class="mr-2">
          Incorrect order
        </label>
        <label class="flex items-center">
          <input type="radio" name="cancelReason" value="Late delivery" class="mr-2">
          Late delivery
        </label>
        <label class="flex items-center">
          <input type="radio" name="cancelReason" value="Found a better price" class="mr-2">
          Found a better price
        </label>
        <label class="flex items-center">
          <input type="radio" name="cancelReason" value="Other" class="mr-2" id="otherReason">
          Other
        </label>

        <!-- Text Field for Other Reason -->
        <div class="hidden w-full mt-2" id="otherReasonTextField">
          <label for="otherReasonInput" class="text-gray-600">Please specify:</label>
          <input type="text" id="otherReasonInput" class="w-full p-2 mt-1 border border-gray-300 rounded-md" placeholder="Enter your reason...">
        </div>
      </div>

      <!-- Confirm Cancel Button -->
      <button class="w-[195px] h-[45px] mb-4 font-bold text-white transition bg-green-500 rounded-md hover:bg-green-600">
        Confirm
      </button>

  <script>
    // Show/Hide the 'Other' reason input field based on radio button selection
    document.getElementById('otherReason').addEventListener('change', function() {
      const textField = document.getElementById('otherReasonTextField');
      if (this.checked) {
        textField.classList.remove('hidden');
      } else {
        textField.classList.add('hidden');
      }
    });
  </script>

</body>
</html>
