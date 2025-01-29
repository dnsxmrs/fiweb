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

            <form action="{{ route('user.new') }}" method="POST">
                @csrf

                @if($errors->any())
                <div class="mb-4 text-red-500">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
                <!-- First Name Section -->
                <div>
                    <h3 class="mb-2 text-sm font-semibold text-gray-800">First Name <span class="text-red-500">*</span></h3>
                    <input type="text" placeholder="First Name *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none" name="first_name" required value="{{ old('first_name') }}">
                    @error('first_name')
                        <p class="pl-1 mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name Section -->
                <div>
                    <h3 class="mb-2 text-sm font-semibold text-gray-800">Last Name <span class="text-red-500">*</span></h3>
                    <input type="text" placeholder="Last Name *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none" name="last_name" required value="{{ old('last_name') }}">
                    @error('last_name')
                        <p class="pl-1 mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Section -->
                <div>
                    <h3 class="mb-2 text-sm font-semibold text-gray-800">Email <span class="text-red-500">*</span></h3>
                    <input type="email" placeholder="Email *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none" name="email" required value="{{ old('email') }}">
                    @error('email')
                        <p class="pl-1 mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Contact Number Section -->
                <div>
                    <h3 class="mb-2 text-sm font-semibold text-gray-800">Contact Number <span class="text-red-500">*</span></h3>
                    <input type="tel" placeholder="Contact Number *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none" name="contact_number" required value="{{ old('contact_number') }}">
                    @error('contact_number')
                        <p class="pl-1 mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Section -->
                <div class="relative">
                    <h3 class="mb-2 text-sm font-semibold text-gray-800">Password <span class="text-red-500">*</span></h3>
                    <input type="password" placeholder="Password *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none" name="password" required>
                </div>

                <!-- Confirm Password Section -->
                <div class="relative">
                    <h3 class="mb-2 text-sm font-semibold text-gray-800">Confirm Password <span class="text-red-500">*</span></h3>
                    <input type="password" placeholder="Confirm Password *" class="w-full px-4 py-3 text-gray-800 border rounded-md bg-gray-50 focus:outline-none" name="password_confirmation" required>
                </div>

                <!-- Create Account Button -->
                <button class="w-full py-3 font-medium text-white bg-green-600 rounded-md hover:bg-green-700" type="submit">
                    Create Account
                </button>
            </form>

            <!-- Login Prompt -->
            <p class="mt-6 text-sm text-center text-gray-600">
                Already have an account? <a href="#" class="font-semibold text-green-600">Login</a>
            </p>
        </div>

    <script>
    function togglePassword(button) {
        const input = button.parentElement.querySelector('input');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
    </script>
</body>
</html>