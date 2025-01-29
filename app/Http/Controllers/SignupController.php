<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Throwable;

class SignupController extends Controller
{
    // Show the signup form
    public function showSignupForm()
    {
        return view('account.sign-up'); // This should be your signup form view
    }

    // Store new user (signup)
    public function store(Request $request)
    {

        \Log::info('Signup request data:', $request->all());


        $validatedData = $request->validate([
            'first_name' => 'required|max:255|regex:/^[A-Za-z\s.-]+$/',
            'last_name' => 'required|string|max:255|regex:/^[A-Za-z\s.-]+$/',
            'email' => 'required|email|unique:users|max:255',
            'contact_number' => 'required|numeric|unique:users,contact_number',
            'password' => 'required|string|min:8|confirmed', // Ensures the password is confirme
        ]);


        try {
            // Create a new user
            $user = User::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'email' => $validatedData['email'],
                'contact_number' => $validatedData['contact_number'],
                'password' => Hash::make($validatedData['password']), // Hash the password
            ]);

            // Redirect with success message
            return redirect()->route('order-now')->with('success', 'Account created successfully!');
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('Error creating user: ' . $e->getMessage());

            // Handle exceptions and show error message
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }}