<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caffeinated - Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-4xl p-10 bg-white rounded-lg shadow-md">
            <div class="mb-8 text-center">
                <h2 class="mb-3 text-3xl font-bold text-gray-800">Ready to be caffeinated?</h2>
                <p class="text-sm text-gray-600">Tell us more about you so we can give you a better delivery experience.</p>
            </div>

            <!-- User Details Section -->
            <div class="mb-8">
                <h3 class="mb-2 text-sm font-semibold text-gray-800">User Details</h3>
                <div class="grid grid-cols-2 gap-6">
                    <input type="text" placeholder="First Name *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none">
                    <input type="text" placeholder="Last Name *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none">
                </div>
            </div>

            <!-- Login & Contact Section -->
            <div class="mb-8">
                <h3 class="mb-2 text-sm font-semibold text-gray-800">Login & Contact Details</h3>
                <div class="grid grid-cols-2 gap-6">
                    <input type="email" placeholder="Email *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none">
                    <input type="tel" placeholder="Contact Number *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none">
                    <div class="relative">
                        <input type="password" placeholder="Password *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none">
                        <button type="button" class="absolute text-gray-500 -translate-y-1/2 right-3 top-1/2" onclick="togglePassword(this)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    <div class="relative">
                        <input type="password" placeholder="Confirm Password *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none">
                        <button type="button" class="absolute text-gray-500 -translate-y-1/2 right-3 top-1/2" onclick="togglePassword(this)">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Consent Section -->
            <div class="mb-8 text-center">
            <div class="mb-8">
                <label class="flex items-start gap-2 mb-4">
                    <input type="checkbox" class="w-5 h-5 mt-1 border border-gray-300 rounded-full appearance-none checked:bg-green-600 checked:border-transparent focus:outline-none">
                    <span class="text-sm text-gray-600">I consent to the use and processing of my personal information. I am aware of my data privacy rights including the option to withdraw my consent at any time.</span>
                </label>
                <label class="flex items-start gap-2">
                    <input type="checkbox" class="w-5 h-5 mt-1 border border-gray-300 rounded-full appearance-none checked:bg-green-600 checked:border-transparent focus:outline-none">
                    <span class="text-sm text-gray-600">I have fully read, understood, and agree to the Data Privacy Policy, Terms & Conditions.</span>
                </label>
            </div>
            </div>

            <!-- Create Account Button -->
            <button class="w-full py-3 font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                Create Account
            </button>

            <!-- Login Prompt -->
            <p class="mt-6 text-sm text-center text-gray-600">
                Already have an account? <a href="#" class="font-semibold text-green-600">Login</a>
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