<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    input::placeholder {
      color: #a0aec0;
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
  <div class="bg-white shadow-lg rounded-[15px] w-[560px] h-[600px] p-12 flex flex-col items-center">
    <!-- Logo -->
    <img src="{{asset('assets/Caffeinated Logo.png') }}" alt="Logo" class="mb-10 w-30 h-30">

    <!-- Heading -->
    <h1 class="mb-6 text-2xl font-bold text-gray-800">Reset password</h1>

    <!-- Subtext -->
    <p class="mb-10 text-sm text-center text-gray-600">
      Please enter the email address you used to register your account
    </p>

    <!-- Email Input -->
    <form action="#" method="POST" class="flex flex-col items-center w-full space-y-8">
      <div class="w-full">
        <label for="email" class="block mb-2 text-sm font-medium text-gray-700">
          Email <span class="text-red-500">*</span>
        </label>
        <input id="email" name="email" type="email" placeholder="Enter your email address" required
          class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
      </div>

      <!-- Reset Password Button -->
      <button
        class="w-full px-4 py-3 text-white bg-green-700 rounded-full hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        Reset Password
      </button>

      <!-- Back to Login -->
      <a href="#" class="text-sm font-medium text-gray-800 hover:underline">
        Back to login
      </a>
    </form>
  </div>
</body>

</html>
