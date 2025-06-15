<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Booking;
use App\Models\Payment;

class MidtransCallbackController extends Controller
{
    public function handleCallback(Request $request)
    {
        Log::info('Midtrans Callback Request Received', $request->all());

        // Decode JSON payload
        $notification = json_decode($request->getContent(), true);

        if (!$notification) {
            Log::error('Invalid JSON data received.');
            return response()->json(['message' => 'Invalid JSON data'], 400);
        }

        // Validate required fields
        if (!isset($notification['order_id'], $notification['status_code'], $notification['gross_amount'], $notification['signature_key'])) {
            Log::error('Incomplete notification data.', $notification);
            return response()->json(['message' => 'Incomplete notification data'], 400);
        }

        Log::info('Notification received:', $notification);

        $serverKey = config('midtrans.server_key');
        $isProduction = config('midtrans.is_production');

        Log::info('Server Key from config: ' . $serverKey);
        Log::info('Environment is production: ' . ($isProduction ? 'Yes' : 'No'));

        // Data for signature key calculation
        $orderId = $notification['order_id'];
        $statusCode = $notification['status_code'];
        $grossAmount = $notification['gross_amount'];
        $receivedSignatureKey = $notification['signature_key'];

        // Calculate the expected signature key
        $calculatedSignatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        // Validate signature key
        if ($calculatedSignatureKey !== $receivedSignatureKey) {
            Log::error('Invalid signature key.', [
                'expected_key' => $calculatedSignatureKey,
                'received_key' => $receivedSignatureKey,
            ]);
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        Log::info('Valid signature key.');

        // Extract booking ID from order ID
        if (!preg_match('/^ORDER-\d+$/', $orderId)) {
            Log::error('Invalid order ID format.', ['order_id' => $orderId]);
            return response()->json(['message' => 'Invalid order ID format'], 400);
        }

        $bookingCode = explode('-', $orderId)[1] ?? null;
        $booking = Booking::where('booking_id', $bookingCode)->first();

        if (!$booking) {
            Log::error('Booking not found for code.', ['booking_code' => $bookingCode]);
            return response()->json(['message' => 'Booking not found'], 404);
        }

        // Handle transaction status
        $transactionStatus = $notification['transaction_status'];
        $paymentType = $notification['payment_type'];

        try {
            DB::transaction(function () use ($booking, $transactionStatus, $paymentType) {
                // Update booking status
                switch ($transactionStatus) {
                    case 'capture':
                    case 'settlement':
                        $booking->update(['status' => 'paid']);
                        break;
                    case 'pending':
                        $booking->update(['status' => 'pending']);
                        break;
                    case 'deny':
                    case 'cancel':
                    case 'expire':
                        $booking->update(['status' => 'cancelled']);
                        break;
                    case 'challenge':
                        $booking->update(['status' => 'pending']);
                        break;
                }

                // Update or create payment information
                $payment = Payment::firstOrNew(['booking_id' => $booking->booking_id]);
                $payment->fill([
                    'payment_status' => $transactionStatus,
                    'payment_method' => $paymentType,
                ])->save();
            });

            Log::info('Callback processed successfully for order ID.', ['order_id' => $orderId]);

            return response()->json(['message' => 'Callback processed successfully'], 200);
        } catch (\Throwable $e) {
            Log::error('Error processing transaction.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'Failed to process transaction'], 500);
        }
    }
}
