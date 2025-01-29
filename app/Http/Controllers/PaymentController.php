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


            $paymentType = $orders['paymentDetails']['paymentType'];
            $deliveryFee = $orders['paymentDetails']['deliveryFee'];
            // // paymentType
            // $paymentType = $orders['paymentDetails']['paymentType'];

            $storeOrder = new OrderController();
            $orderCreated = $storeOrder->storeOrder(new Request($orders));

            if ($orderCreated) {
                // Extract order data from the response
                $extractedOrder = $orderCreated->getData()->data;

                // Log::info('d',);

                Log::info('what is dis', [
                    'req' => (array)$extractedOrder,
                ]);

                $orderProducts = OrderProduct::where('order_id', $extractedOrder->id)
                ->with('product')
                ->get();

                $items = [];

                Log::info($orderProducts);

                foreach ($orderProducts as $orderProduct) {
                    if ($orderProduct->product && $orderProduct->product->name) {

                        $items[] = [
                            'name' => $orderProduct->product->name,
                            'quantity' => $orderProduct->quantity,
                            'amount' => $orderProduct->price * 100, // Convert to PHP cents
                            'currency' => 'PHP',
                            'description' => $extractedOrder->order_number,
                        ];
                    }
                }

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
                            'description' => $extractedOrder->order_number,
                            'metadata' => [
                                'order_id' => base64_encode($extractedOrder->id),
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

                $checkOutUrl = $response->data->attributes->checkout_url;

                return response()->json([
                    'success' => true,
                    'message' => 'Successful payment processing',
                    'redirect' => $checkOutUrl,
                ]);

            }

            Log::error('Order could not be created');
            return response()->json(['error' => 'Order creation failed'], 400);
        } catch (\Exception $e) {
            Log::error($e);

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function orders()
    {
        $sessionId = Session::get('session_id');
        Log::info('Session ID: ' . $sessionId);

        $response = Curl::to('https://api.paymongo.com/v1/checkout_sessions/' . $sessionId)
        ->withHeader('Content-Type: application/json')
        ->withHeader('Accept: application/json')
        ->withHeader('Authorization: Basic ' . base64_encode(env('AUTH_PAY')))
        ->asJson()
        ->get();

        if ($response->data->attributes->payments[0]->attributes->status === "paid") {
            // Log::info((array) $response);
            Log::info('Logging object:', ['object' => json_encode($response)]);

            $orderId = (int) base64_decode($response->data->attributes->metadata->order_id);
            $amount = $response->data->attributes->payments[0]->attributes->amount;
            $description = $response->data->attributes->payments[0]->attributes->description;
            $modeOfPayment = $response->data->attributes->payment_method_used;
            $status = $response->data->attributes->payments[0]->attributes->status;

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

            Log::info('Payment stored: ', json_decode($payment->getContent(), true));
            Log::info('Payment Log object:', ['object' => json_encode($payment)]);

            if (!$payment) {

                return response()->json([
                    'message' => 'Unsuccessful to save payment'
                ], 400);
            }

            $this->pushOrder($orderId);

            return $this->showDetails($orderId);
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

    public function showDetails($orderId = null)
    {
        if (!$orderId) {
            return view('order-checkout.order-details');
        }

        // retrieve order based on orderid
        $orders = Order::find($orderId);

        // get the order and the orderProduct and pass to view
        $orderProducts = OrderProduct::where('order_id', $orderId)
        ->with('product')
        ->get();

        // get the corresponding payment
        $payments = Payment::where('order_id', $orderId)->first();

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
