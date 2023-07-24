<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Payment;

class StripeController extends Controller
{
    public function index(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $description = 'Example Payment';

        $transaction_id = 'yk_' . mt_rand(100000000, 999999999) . PHP_EOL;

        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => env('STRIPE_CURRENCY'),
                        'unit_amount' => $request->amount * 100,
                        'product_data' => [
                            'name' => $description,
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => url('/api/stripe/success') . '?transaction_id=' . $transaction_id,
            'cancel_url' => url('/error'),
        ]);

        $payment = new Payment;
        $payment->payment_id = $checkoutSession->id;
        $payment->payer_id = mt_rand(100000000, 999999999) . PHP_EOL;
        $payment->payer_email = $request->email;
        $payment->amount = $request->amount;
        $payment->currency = env('STRIPE_CURRENCY');
        $payment->payment_status = $checkoutSession->payment_status;
        $payment->type = 'stripe';
        $payment->transaction_id = $transaction_id;
        $payment->status = 0;
        $payment->save();

        return $checkoutSession->url;
    }

    public function success(Request $request)
    {
        $payment = Payment::where('transaction_id', $request->transaction_id)->first();

        return $payment;

        $payment->payment_status = 'approved';
        $payment->status = 1;
        $payment->save();

        return redirect('/api/success');
    }
}
