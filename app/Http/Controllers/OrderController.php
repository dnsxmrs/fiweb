<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function saveContactDetails(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^\+?[0-9]{10,15}$/', // Ensures a valid phone number
            'address' => 'required|string|max:500',
            'postalCode' => 'required|regex:/^[A-Za-z0-9\s\-]{3,10}$/', // Postal code format
        ]);

        if ($validator->fails()) {
            // Return validation errors as JSON or redirect with errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Encrypt the validated data
        $validatedData = $validator->validated();  // Use validated data instead of $validator
        $encryptedData = [
            'name' => Crypt::encryptString($validatedData['name']),
            'phone' => Crypt::encryptString($validatedData['phone']),
            'address' => Crypt::encryptString($validatedData['address']),
            'postalCode' => Crypt::encryptString($validatedData['postalCode']),
        ];

        // Save $encryptedData to the database or use as needed
        // For example, create a new order record or update the database
        // Order::create($encryptedData);

        return response()->json(['message' => 'Contact details saved securely.']);
    }

    public function showContactForm()
    {
        return view('components.contact'); // Ensure this matches the Blade file name
    }
}
