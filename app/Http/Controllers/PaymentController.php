<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\OrderProduct;
use Ixudra\Curl\Facades\Curl;

use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{
    //
    public function validateRequest(Request $request)
    {
        try {
            $validatedRequest = $request->validate([
                // Customer details validation
                'customerDetails.firstName' => 'required|string|max:255',
                'customerDetails.lastName' => 'required|string|max:255',
                'customerDetails.contactNumber' => 'required',
                                            // |regex:/^\+?[0-9]{10,15}$/
                'customerDetails.email' => 'required|email|max:255',

                // Address details validation
                'addressDetails.region' => 'required|string|max:255',
                'addressDetails.province' => 'required|string|max:255',
                'addressDetails.municipality' => 'required|string|max:255',
                'addressDetails.barangay' => 'required|string|max:255',
                'addressDetails.street' => 'required|string|max:255',
                'addressDetails.unit' => 'nullable|string|max:255',
                'addressDetails.addressType' => 'required|in:Residential,Office',

                // Payment details validation
                'paymentDetails.paymentType' => 'required|in:card,cash,cashless',
                'paymentDetails.subtotal' => 'required|numeric|min:0',
                'paymentDetails.deliveryFee' => 'required|numeric|min:0',
                'paymentDetails.tax' => 'required|numeric|min:0',
                'paymentDetails.total' => 'required|numeric|min:0',

                // Order details validation
                'orderDetails.items' => 'required|array',
                'orderDetails.items.*.id' => 'required|integer|exists:products,id',
                'orderDetails.items.*.quantity' => 'required|integer|min:1',
                'orderDetails.items.*.price' => 'required|numeric|min:0',
                'orderDetails.deliveryTime' => 'required|string|max:255',
                'orderDetails.note' => 'nullable|string|max:500',
            ]);

            // Return the validated request
            return $validatedRequest;
        } catch (ValidationException $e) {
            Log::error('Validation Errors:', $e->errors());
            return response()->json(['errors' => $e->errors()], 422);
        }
    }




    public function pay(Request $request)
    {
        try{
            // Validate the request
            $validatedRequest = $this->validateRequest($request);
            Log::info('Validated request: ', $validatedRequest);

            $tax = $validatedRequest['paymentDetails']['tax'];
            $deliveryFee = $validatedRequest['paymentDetails']['deliveryFee'];
            $total = $validatedRequest['paymentDetails']['total'];
            // paymentType
            $paymentType = $validatedRequest['paymentDetails']['paymentType'];

            // Log the tax, total amount and delivery fee
            Log::info('Tax: ' . $tax);
            Log::info('Delivery Fee: ' . $deliveryFee);
            Log::info('Total: ' . $total);

            $storeOrder = new OrderController();
            $orderCreated = $storeOrder->storeOrder(new Request($validatedRequest));
            Log::info('Order created: ', json_decode($orderCreated->getContent(), true));

            // Extract order data from the response
            $extractOrder = json_decode($orderCreated->getContent(), true)['data'];
            Log::info('Extracted Order: ', $extractOrder);

            // Debugging data types
            var_dump($extractOrder);  // Expected: array
            // var_dump($items);         // Expected: array of associative arrays


            $orderProducts = OrderProduct::where('order_id', $extractOrder['id'])
                ->with('product')
                ->get();
            // Ensure you pass it as an array
            var_dump($orderProducts); // Expected: Eloquent Collection
            Log::info($orderProducts);
            $decodedData = json_decode($orderProducts, true); // Decoding as an associative array
            Log::info($decodedData);

            $items = [];
            foreach ($decodedData as $selectedProduct) {
                if ($selectedProduct['product'] && $selectedProduct['product']['name']) {
                    $items[] = [
                        'name' => $selectedProduct['product']['name'],
                        'quantity' => (int) $selectedProduct['quantity'],
                        'amount' => $selectedProduct['price'] * $selectedProduct['quantity'] * 100,
                        'currency' => 'PHP',
                        'description' => $extractOrder['order_number'],
                    ];
                }
            }
            Log::info('Items: ', $items);

            // Add taxes as a line item
            $items[] = [
                'name' => 'Tax (12%)',
                'quantity' => 1,
                'amount' => intval($tax * 100), // Convert to PHP cents
                'currency' => 'PHP',
                'description' => 'VAT Tax',
            ];

            // Add taxes as a line item
            $items[] = [
                'name' => 'Delivery Fee',
                'quantity' => 1,
                'amount' => intval($deliveryFee * 100), // Convert to PHP cents
                'currency' => 'PHP',
                'description' => 'Delivery Fee Amount',
            ];

            // Log the items
            Log::info('Items: ', $items);


            // // create payment
            // // transform the array to be sent
            // $payment = [
            //     'order_id' => $extractOrder->id,
            //     'amount' => $extractOrder->total,
            //     'description' => 'Payment for ' . $extractOrder->order_number,
            //     'mode_of_payment' => $validatedRequest['paymentDetails']['paymentType'],
            //     'status' => 'paid'
            // ];

            $data = [
                'data' => [
                    'attributes' => [
                        'send_email_receipt' => false,
                        'show_description' => true,
                        'show_line_items' => true,
                        'line_items' => $items,
                        'payment_method_types' => [
                            $paymentType
                        ],
                        'success_url' => route('orders'),
                        'cancel_url' => route('checkout'),
                        'description' => $extractOrder['order_number'],
                        'metadata' => [
                            'order_id' => base64_encode($extractOrder['order_number']),
                        ]
                    ],
                ]
            ];

            Log::info('Payload sent to PayMongo:', ['payload' => $data]);

            // Send POST request to PayMongo's checkout endpoint
            $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
            ->withHeader('Content-Type: application/json')
            ->withHeader('Accept: application/json')
            ->withHeader('Authorization: Basic ' . base64_encode(env('AUTH_PAY')))
            ->withData($data)
            ->asJson()
            ->post();

            // Log the response to check its structure
            Log::info('PayMongo Response:', (array) $response);

            // Check if the 'data' property exists before accessing it
            if (isset($response->data)) {
                Session::put('session_id', $response->data->id);
            } else {
                // Handle the error or log the response if 'data' is missing
                Log::error('Error: PayMongo response does not contain "data" property');
                // You may also handle a fallback or return a specific error to the user
            }

            $checkOutUrl = $response->data->attributes->checkout_url;

            // Return with checkout url for redirection
            return response()->json([
                'success' => true,
                'message' => 'Successful payment processing',
                'redirect' => $checkOutUrl
            ]);

        } catch (\Exception $e) {
            Log::error($e);

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function orders()
    {
        // get all orders from this session

        return view('order-checkout.order-details');
    }
}
