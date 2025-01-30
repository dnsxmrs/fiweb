<?php

namespace App\Http\Controllers;

use App\Http\Controllers\OrderController;
use App\Models\Payment;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Http;

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
                'paymentDetails.paymentType' => 'required|in:card,gcash,paymaya',
                'paymentDetails.subtotal' => 'required|numeric|min:0',
                'paymentDetails.deliveryFee' => 'required|numeric|min:0',
                'paymentDetails.total' => 'required|numeric|min:0',

                // Order details validation
                'orderDetails.items' => 'required|array',
                'orderDetails.items.*.id' => 'required|integer|exists:products,id',
                'orderDetails.items.*.name' => 'required|string|max:255',
                'orderDetails.items.*.quantity' => 'required|integer|min:1',
                'orderDetails.items.*.price' => 'required|numeric|min:0',
                'orderDetails.deliveryTime' => 'required|string|max:255',
                'orderDetails.note' => 'nullable|string|max:500',
            ]);

            Log::error('Order validation payment', [
                'req' => $validatedRequest,
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
            // Validate and process request data
            $orders = $this->validateRequest($request);

            Log::info('Type of $orders:', [gettype($orders)]); // Should output "array"
            Log::info('Structure of $orders:', $orders); // Prints the entire array

            $paymentType = $orders['paymentDetails']['paymentType'];
            $deliveryFee = $orders['paymentDetails']['deliveryFee'];

            $items = [];

            // Convert associative array to indexed array
            $orderItems = array_values($orders['orderDetails']['items']);

            $orderNumber = '';
            do {
                $orderNumber = 'CAFOL' . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
            } while (Order::where('order_number', $orderNumber)->exists());

            foreach ($orderItems as $orderItem) {
                if (isset($orderItem['name'])) {  // Check if 'name' exists
                    $items[] = [
                        'name' => $orderItem['name'], // Access name directly
                        'quantity' => $orderItem['quantity'],
                        'amount' => $orderItem['price'] * 100, // Convert to PHP cents
                        'currency' => 'PHP',
                        'description' => $orderNumber,
                    ];
                }
            }

            // Add Delivery Fee
            $items[] = [
                'name' => 'Delivery Fee',
                'quantity' => 1,
                'amount' => intval($deliveryFee * 100), // Convert to PHP cents
                'currency' => 'PHP',
                'description' => 'Delivery Fee Amount',
            ];

            if (empty($items)) {
                Log::error('No valid items to process for payment');
                return response()->json([
                    'error' => 'No valid items to process for payment'
                ], 400);
            }

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
                        'description' => $orderNumber,
                        'metadata' => [
                            'order_number' => base64_encode($orderNumber),
                        ]
                    ],
                ]
            ];

            // Send POST request to PayMongo's checkout endpoint
            $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions')
                ->withHeader('Content-Type: application/json')
                ->withHeader('Accept: application/json')
                ->withHeader('Authorization: Basic ' . base64_encode(env('AUTH_PAY')))
                ->withData($data)
                ->asJson()
                ->post();

            // Store session ID in the session
            Session::put('session_id', $response->data->id);

            Session::put('pending_order', $orders);

            $checkOutUrl = $response->data->attributes->checkout_url;

            Log::info('Print items', [
                'items' => $items,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Successful payment processing',
                'redirect' => $checkOutUrl,
            ]);
        } catch (\Exception $e) {
            Log::error($e);

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function orders()
    {
        $sessionId = Session::get('session_id');
        $orders = Session::get('pending_order');

        // Log::info('Session ID: ' . $sessionId);
        // Log::info('Pending Order: '. $orders);

        // dd to see session id and pending order
        // Dump and die to inspect the values
        // dd($sessionId, $orders);

        $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions/' . $sessionId)
        ->withHeader('Content-Type: application/json')
        ->withHeader('Accept: application/json')
        ->withHeader('Authorization: Basic ' . base64_encode(env('AUTH_PAY')))
        ->asJson()
        ->get();

        Log::info('Response: ', ['response' => $response]);

        if (collect($response->data->attributes->payments)->contains('attributes.status', 'paid')) {
            Log::info('Logging object:', ['object' => json_encode($response)]);

            // $order_number = (int) base64_decode($response->data->attributes->metadata->order_number);
            $amount = $response->data->attributes->payments[0]->attributes->amount;
            $description = $response->data->attributes->payments[0]->attributes->description;
            $modeOfPayment = $response->data->attributes->payment_method_used;
            $status = $response->data->attributes->payments[0]->attributes->status;

            $storeOrder = new OrderController();
            $orderCreated = $storeOrder->storeOrder(new Request($orders));

            if ($orderCreated) {
                // Extract order data from the response
                $extractedOrder = $orderCreated->getData()->data;
                $orderId = $extractedOrder->id;

                Log::info("message", [
                    'order_id' => $orderId,
                    'total' => $amount,
                    'description' => $description,
                    'payment_type' => $modeOfPayment,
                    'status' => $status,
                ]);

                // load the details
                $paymentToStore = [
                    'order_id' => $orderId,
                    'total' => $amount,
                    'description' => 'Payment for ' . $description,
                    'payment_type' => $modeOfPayment,
                    'status' => $status,
                ];
                Log::info('Payment to store: ', $paymentToStore);

                $payment = $this->storePayment(new Request($paymentToStore));

                if (!$payment) {
                    return response()->json([
                        'message' => 'Unsuccessful to save payment'
                    ], 400);
                }
                Log::info('Payment stored: ', json_decode($payment->getContent(), true));

                $this->pushOrder($orderId);

                // get ordernumber of the order
                $orderget = Order::where('id', $orderId)->first();

                $order_number = $orderget['order_number'];

                Session::forget('pending_order');
                Session::forget('session_id');

                // return $this->showDetails($orderId);
                return redirect()->route('showDetails', ['orderNumber' => $order_number]);

            }
        }
    }

    public function storePayment(Request $request)
    {
        $payment = $request->validate([
            'order_id' => 'nullable|exists:orders,id',
            'total' => 'required|numeric|min:0',
            'description' => 'nullable|max:255',
            'payment_type' => 'required|in:cash,card,gcash,paymaya',
            'status' => 'required|in:paid,unpaid',
        ]);

        Log::info('Payment: ', $payment);

        // create payment record
        $recordedPayment = Payment::create([
            'order_id' => $payment['order_id'],
            'total' => $payment['total'],
            'description' => $payment['description'],
            'payment_type' => $payment['payment_type'],
            'status' => 'paid'
        ]);

        Log::info($recordedPayment);

        return response()->json([
            'success' => true,
            'message' => 'Payment recorded successfully',
            'data' => $recordedPayment
        ], 200);
    }

    public function showDetails($orderNumber = null)
    {
        if (!$orderNumber) {
            return view('order-checkout.order-details');
        }

        // retrieve order based on orderid
        $orders = Order::where('order_number', $orderNumber)->first(); // Use order_number to find the order

        // get the order and the orderProduct and pass to view
        $orderProducts = OrderProduct::where('order_id', $orders->id)
        ->with('product')
        ->get();

        // get the corresponding payment
        $payments = Payment::where('order_id', $orders->id)->first();

        Log::info($orders);
        Log::info($orderProducts);

        return view('order-checkout.order-details', compact('orderProducts', 'orders', 'payments'));
    }

    // push order to posapi
    public function pushOrder($order_id)
    {
        $order = Order::find($order_id);

        $order_status = $order->status;
        $order_number = $order->order_number;
        $order_date = $order->created_at;
        $order_time = $order->created_at;
        $notes = $order->note ?? 'No notes provided';

        $orderProducts = OrderProduct::where('order_id', $order_id)
            ->with('product')
            ->get();

        $orderItems = [];
        foreach ($orderProducts as $orderProduct) {
            if ($orderProduct->product && $orderProduct->product->name) {
                $orderItems[] = [
                    'name' => $orderProduct->product->name,
                    'quantity' => (int) $orderProduct->quantity,
                    'price' => (float) $orderProduct->price
                ];
            }
        }

        $pushOrder = [
            'order_id' => $order_id,
            'order_status' => $order_status,
            'order_number' => $order_number,
            'order_date' => $order_date,
            'order_time' => $order_time,
            'order_items' => $orderItems,
            'notes' => $notes,
        ];

        Log::info('Pushing order rrr to pos', [
            'pushorDER' => $pushOrder,
        ]);
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('WEB_API_KEY'), // Include the Authorization Bearer token
                // 'X-CSRF-TOKEN' => $csrfToken, // Include the CSRF token if necessary
            ])->send('post', env('PUSH_ORDER_POS'), [
                'json' => $pushOrder, // Send data as JSON
            ]);

            if ($response->failed()) {
                Log::error('Failed to sync with OOS', [
                    'status' => $response->status(),
                    'message' => $response->body(),
                    'headers' => $response->headers(),
                    'request_payload' => $pushOrder, // Log the payload you sent
                    'request_url' => env('PUSH_ORDER_POS'), // Log the target URL
                ]);
            } else {
                Log::info('Successfully synced with OOS', [
                    'status' => $response->status(),
                    'message' => $response->body(),
                    'headers' => $response->headers(),
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error syncing with OOS', [
                'error' => $e->getMessage(),
            ]);
        }
    }
}
