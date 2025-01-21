<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verification Page</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Poppins';
    }
  </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
  <div class="bg-white shadow-lg rounded-[15px] w-[700px] h-[500px] p-12 flex flex-col items-center">
    <!-- Icon -->
    <img src="{{asset('assets/Send Email.png') }}" alt="deleteIcon" class="h-32 mb-10 w-50">

    <!-- Heading -->
    <h1 class="mb-6 text-2xl font-bold text-center text-gray-800">Thank you for signing up!</h1>

    <!-- Subtext -->
    <p class="mb-4 text-sm text-center text-gray-600 py-50">
      Now let's verify your account so you can start ordering your favorites.
    </p>
    <p class="mb-10 text-sm text-center text-gray-600 py-50">
      Check your registered email and click on the link provided to activate your account.
    </p>

    <!-- Did not receive email -->
    <p class="mb-4 text-sm italic text-center text-gray-600">
      Didn't receive an email?
    </p>

    <!-- Resend Button -->
    <button class="bg-green-700 text-white py-3 px-6 rounded-[20px] hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
      Resend verification email
    </button>
  </div>
</body>

</html>