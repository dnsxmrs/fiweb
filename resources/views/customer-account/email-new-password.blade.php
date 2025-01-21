<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset</title>
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
  <div class="bg-white shadow-lg rounded-[15px] w-[600px] h-[400px] p-12 flex flex-col items-center justify-center">
    <!-- Icon -->
    <img src="{{asset('assets/Envelope Dots.png') }}" alt="Envelope Icon" class="mb-6 w-25 h-25">

    <!-- Heading -->
    <h1 class="mb-4 text-xl font-bold text-center text-gray-800">
      You're on your way to a new password!
    </h1>

    <!-- Subtext -->
    <p class="mb-8 text-sm text-center text-gray-600">
      Check your registered email and click on the provided link so you can reset your password and resume ordering your favorites!
    </p>

    <!-- Back to Login Button -->
    <button
      class="w-[250px] bg-green-700 text-white py-3 px-6 rounded-full hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-md">
      Back to login
    </button>
  </div>
</body>

</html>
