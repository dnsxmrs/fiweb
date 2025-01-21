<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Caffeinated Create Account</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins';
    }

    input::placeholder {
      color: #a0aec0;
    }

    label .required {
      color: #e53e3e;
      
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
  <div class="bg-white shadow-lg rounded-[15px] w-[1000px] h-[800px] p-12 flex flex-col items-center" style="padding-top: 40px;">
    <h1 class="mb-1 text-2xl font-semibold text-gray-800">Ready to be caffeinated?</h1>
    <p class="mb-5 text-sm text-gray-600">Tell us more about you so we can give you a better delivery experience.</p>

    <form action="#" method="POST" class="w-full space-y-5">
      <div>
        <h4 class="pb-3 mb-1 text-lg font-semibold text-gray-800">User Details</h4>
      <!-- User Details -->
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="first-name" class="block text-sm font-medium text-gray-700">First Name <span class="required">*</span></label>
          <input id="first-name" name="first-name" type="text" placeholder="Enter your first name" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
        </div>

        <div>
          <label for="last-name" class="block text-sm font-medium text-gray-700">Last Name <span class="required">*</span></label>
          <input id="last-name" name="last-name" type="text" placeholder="Enter your last name" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
        </div>
      </div>
    </div>

      <!-- Login & Contact Details -->
      <div>
        <h4 class="py-3 mb-1 text-lg font-semibold text-gray-800">Login & Contact Details</h4>
      
      <div class="pb-5">
        <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="required">*</span></label>
        <input id="email" name="email" type="email" placeholder="Enter your email address" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
      </div>

      <div class="pb-5">
        <label for="contact-number" class="block text-sm font-medium text-gray-700">Contact Number <span class="required">*</span></label>
        <input id="contact-number" name="contact-number" type="tel" placeholder="Enter your contact number" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
      </div>

      <div class="grid grid-cols-2 gap-4 pb-5">
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Password <span class="required">*</span></label>
          <input id="password" name="password" type="password" placeholder="Enter your password" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
        </div>

        <div class="pb-5">
          <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password <span class="required">*</span></label>
          <input id="confirm-password" name="confirm-password" type="password" placeholder="Confirm your password" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
        </div>
      </div>
    </div>
      <!-- Consent Checkboxes -->
      <div class="px-12 space-y-4" style="margin-top: 0px;">
        <div class="flex items-start">
          <input id="consent" name="consent" type="checkbox" required class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
          <label for="consent" class="block ml-2 text-sm text-gray-700">I consent to the use and processing of my personal information. I am aware of my data privacy rights including the option to withdraw my consent at any time.</label>
        </div>

        <div class="flex items-start px-12 pb-5">
          <input id="privacy" name="privacy" type="checkbox" required class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
          <label for="privacy" class="block ml-2 text-sm text-gray-700">I have fully read, understood, and agree to the Data Privacy Policy, Terms & Conditions.</label>
        </div>
      </div>

      <!-- Submit Button Container -->
      <div class="text-center">
        <button type="submit" class="inline-block w-[250px] bg-green-800 text-white py-2 px-4 rounded-[20px] hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
          Create Account
        </button>
      </div>
    </form>

    <!-- Login Link -->
    <p class="mt-4 text-sm text-center text-gray-600">Already have an account? <a href="#" class="font-medium text-green-600 hover:text-green-700">Login</a></p>
  </div>
</body>

</html>
