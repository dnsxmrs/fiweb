<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caffeinated - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-4xl p-10 bg-white rounded-lg shadow-md">
            <div class="mb-8 text-center">
                <h2 class="mb-3 text-3xl font-bold text-gray-800">Enter your credentials below.</h2>
            </div>

            <!-- Login & Contact Section -->
            <div class="mb-8">
                <h3 class="mb-2 text-sm font-semibold text-gray-800">Email</h3>
                <div class="grid grid-cols-1 gap-6">
                    <input type="email" placeholder="Email *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none">

                    <div class="relative">
                        <!-- Added label here for the password field -->
                        <h3 class="mb-2 text-sm font-semibold text-gray-800">Password</h3>
                        <input type="password" placeholder="Password *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none">
                        <button type="button" class="absolute text-gray-500 -translate-y-1/2 right-3 top-1/2" onclick="togglePassword(this)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>


            <!-- Create Account Button -->
            <button class="w-full py-3 font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                Log in
            </button>

            <!-- Login Prompt -->
            <p class="mt-6 text-sm text-center text-gray-600">
                Don't have an account? <a href="#" class="font-semibold text-green-600">Sign up</a>
            </p>
        </div>
    </div>

    <script>
    function togglePassword(button) {
        const input = button.parentElement.querySelector('input');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
    </script>
</body>
</html>