<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Payment;

class PaymentController extends Controller
{
    private $gateway;

    public function __construct()
    {
        $redirect_link = '';
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

    /**
     * Call a view.
     */
    public function index()
    {
        return view('payment');
    }

    /**
     * Initiate a payment on PayPal.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function charge(Request $request)
    {
        // if($request->input('submit'))
        // {
        try {
            $amountInDollars = $request->input('amount');
            $amountInCents = $amountInDollars * 100; // Convert to cents

            $response = $this->gateway->purchase(array(
                'amount' => $amountInCents,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('success'),
                'cancelUrl' => url('error'),
            ))->send();

            if ($response->isRedirect()) {
                $data = [
                    'redirect_url' => $response->getRedirectUrl()
                ];
                return response()->json($data);
            } else {
                // not successful
                return response()->json(['message' => $response->getMessage()], 500);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
        // }
    }


    /**
     * Charge a payment and store the transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $payment = new Payment;
                $payment->payment_id = $arr_body['id'];
                $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr_body['state'];
                $payment->save();

                return view('content.paypal.success');
                // return "Payment is successful. Your transaction id is: ". $arr_body['id'];
            } else {
                return response()->json(['success' => false, 'data' => $response->getMessage()]);
                // return $response->getMessage();
            }
        } else {
            return response()->json(['success' => false, 'data' => 'Transcation is declined.']);
            // return 'Transaction is declined';
        }
    }

    /**
     * Error Handling.
     */
    public function error()
    {
        return response()->json(['success' => false, 'data' => 'User Cancelled the payment.']);
        // return 'User cancelled the payment.';
    }
}
