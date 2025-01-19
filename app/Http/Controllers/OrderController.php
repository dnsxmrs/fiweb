<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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

    public function storeOrder(Request $request)
    {
        try {
            // validate order data
            $orders = $request->validate([
                'customerDetails.firstName' => 'required|string|max:255',
                'customerDetails.lastName' => 'required|string|max:255',
                'customerDetails.contactNumber' => 'required',
                // |regex:/^\+?[0-9]{10,15}$/
                'customerDetails.email' => 'required|email|max:255',

                'addressDetails.region' => 'required|string|max:255',
                'addressDetails.province' => 'required|string|max:255',
                'addressDetails.municipality' => 'required|string|max:255',
                'addressDetails.barangay' => 'required|string|max:255',
                'addressDetails.street' => 'required|string|max:255',
                'addressDetails.unit' => 'nullable|string|max:255',
                'addressDetails.addressType' => 'required|in:Residential,Office',

                // Order details validation
                'orderDetails.items' => 'required|array',
                'orderDetails.items.*.id' => 'required|integer|exists:products,id',
                'orderDetails.items.*.quantity' => 'required|integer|min:1',
                'orderDetails.items.*.price' => 'required|numeric|min:0',
                'orderDetails.deliveryTime' => 'required|string|max:255',
                'orderDetails.note' => 'nullable|string|max:500',

                'paymentDetails.paymentType' => 'required|in:card,gcash,paymaya',
                'paymentDetails.subtotal' => 'required|numeric|min:0',
                'paymentDetails.deliveryFee' => 'required|numeric|min:0',
                'paymentDetails.tax' => 'required|numeric|min:0',
                'paymentDetails.total' => 'required|numeric|min:0',
            ]);

            // generate ordernumber
            $orderNumber = 'CAFOL' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));

            // create order
            $order = Order::create([
                'order_number' => $orderNumber,
                'order_type' => 'online',
                'total' => $orders['paymentDetails']['total'],
                'tax' => $orders['paymentDetails']['tax'],
                'subtotal' => $orders['paymentDetails']['subtotal'],
                'delivery_fee' => $orders['paymentDetails']['deliveryFee'],
                'status' => 'pending',

                'first_name' => $orders['customerDetails']['firstName'],
                'last_name' => $orders['customerDetails']['lastName'],
                'contact_number' => $orders['customerDetails']['contactNumber'],
                'email' => $orders['customerDetails']['email'],

                'region' => $orders['addressDetails']['region'],
                'province' => $orders['addressDetails']['province'],
                'municipality' => $orders['addressDetails']['municipality'],
                'barangay' => $orders['addressDetails']['barangay'],
                'street' => $orders['addressDetails']['street'],
                'unit' => $orders['addressDetails']['unit'],
                'address_type' => $orders['addressDetails']['addressType'],

                'delivery_time' => $orders['orderDetails']['deliveryTime'],
                'note' => $orders['orderDetails']['note'],
            ]);

            // add the order products to the order
            foreach ($orders['orderDetails']['items'] as $orderItem) {

                // get the product id of the respective name
                $product = Product::where('id', $orderItem['id'])->first();

                // create the order product record
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $orderItem['quantity'],
                    'price' => $orderItem['price'],
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order Created',
                'data' => $order,
            ], 201);

        } catch (ValidationException $e) {
            Log::error('Validation Errors:', $e->errors());
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    public function showContactForm()
    {
        return view('components.contact'); // Ensure this matches the Blade file name
    }
}
