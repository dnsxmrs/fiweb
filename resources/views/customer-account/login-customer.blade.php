<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
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
    <div class="bg-white shadow-lg rounded-[15px] w-[560px] h-[850px] p-12 flex flex-col items-center">
      <!-- Logo -->
      <img src="{{asset('assets/Caffeinated Logo.png') }}" alt="Logo" class="mb-6 w-30 h-30">
  
      <!-- Heading -->
      <h1 class="mb-2 text-2xl font-semibold text-gray-800">Welcome back!</h1>
      <p class="mb-8 text-sm text-gray-600">Sign in to your account.</p>
  
      <!-- Form -->
      <form action="#" method="POST" class="w-full space-y-6">
        <!-- Email -->
        <div>
          <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
          <input id="email" name="email" type="email" placeholder="Email" required
            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
        </div>
  
        <!-- Password -->
        <div>
          <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
          <div class="relative">
            <input id="password" name="password" type="password" placeholder="Password" required
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
            <!-- Icon -->
            <div class="absolute inset-y-0 flex items-center right-3">
              <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
              </svg>
            </div>
          </div>
        </div>
  
        <!-- Forgot Password -->
        <a href="#" class="block mb-4 text-sm text-right text-orange-500 hover:underline">Forgot your password?</a>
  
        <!-- Sign In Button -->
        <button type="submit"
          class="w-full bg-green-700 text-white py-2 px-4 rounded-[20px] hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
          Sign In
        </button>
  
        <!-- Divider -->
        <div class="flex items-center my-6">
          <div class="flex-grow border-t border-gray-300"></div>
          <span class="mx-3 text-sm text-gray-600">or</span>
          <div class="flex-grow border-t border-gray-300"></div>
        </div>
  
        <!-- Continue as Guest -->
        <button type="button"
          class="w-full border border-gray-300 text-gray-700 py-2 px-4 rounded-[20px] hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400">
          Continue as Guest
        </button>
      </form>
  
      <!-- Footer -->
        <p class="mt-6 text-xs leading-relaxed text-center text-gray-500">
            By continuing, you agree to our updated 
            <a href="#terms" class="text-green-600 hover:underline">Terms & Conditions and Privacy Policy</a>.
            Order fast and easy with account.
        </p>
        <p class="mt-4 text-sm text-center text-gray-800">
            Don't have an account yet? Sign up <a href="#" class="font-medium text-green-600 hover:underline">here.</a>
        </p>
    </div>
</body>

</html>
