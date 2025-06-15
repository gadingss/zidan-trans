<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pembayaran setelah booking
     */
    public function showPaymentPage($bookingId)
    {
        $booking = Booking::where('booking_id', $bookingId)->firstOrFail();
        $payment = Payment::where('booking_id', $bookingId)->first();
    
        if (!$payment || !$payment->amount || $payment->amount <= 0) {
            return redirect()->back()->with('error', 'Jumlah pembayaran tidak valid.');
        }
    
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    
        $orderId = 'ORDER-' . $booking->booking_id;
    
        if ($payment->order_id !== $orderId) {
            $payment->order_id = $orderId;
            $payment->save();
        }
    
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int)$payment->amount,
            ],
            'customer_details' => [
                'first_name' => $booking->customer_name ?? 'Customer',
                'email' => $booking->customer_email ?? 'customer@example.com',
            ],
            'item_details' => [
                [
                    'id' => 1,
                    'price' => (int)$payment->amount,
                    'quantity' => 1,
                    'name' => 'Booking ' . $booking->booking_id,
                ],
            ],
        ];
    
        try {
            $snapToken = Snap::getSnapToken($params);
        } catch (\Exception $e) {
            Log::error('Midtrans Snap Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat pembayaran: ' . $e->getMessage());
        }
    
        $totalPrice = (int)$payment->amount;
        return view('booking.payment', compact('snapToken', 'totalPrice'));
    }
    

    /**
     * Endpoint untuk menerima webhook dari Midtrans
     */
    public function midtransNotification(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $notification = new Notification();

        $orderId = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus = $notification->fraud_status;

        Log::info('Midtrans Webhook:', [
            'order_id' => $orderId,
            'transaction_status' => $transactionStatus,
            'fraud_status' => $fraudStatus,
        ]);

        $payment = Payment::where('order_id', $orderId)->first();

        if ($payment) {
            if ($transactionStatus === 'settlement' || ($transactionStatus === 'capture' && $fraudStatus === 'accept')) {
                $payment->status = 'paid';
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $payment->status = 'failed';
            } else {
                $payment->status = $transactionStatus;
            }
            $payment->save();
        }

        return response()->json(['message' => 'OK']);
    }
}
