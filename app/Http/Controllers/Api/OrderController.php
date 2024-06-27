<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Braintree\Gateway;

class OrderController extends Controller
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);
    }

    public function store(Request $request){
        $amount = '10.00';
        $nonceFromTheClient = $request->input('nonceToken');

        $result = $this->gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        $data = $request->all();

        $succes = $result->success;

        if ($result->success) {
            return response()->json([
                'success' => true,
                'transaction' => $result->transaction

                //popoliamo orders

                //popoliamo orders

                //ivio e-mail

                //ivio e-mail

            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $result->message
            ]);
        }

        // return response()->json(compact('nonceFromTheClient', 'result', 'succes'));
    }

    // public function store(Request $request){
    //     $amount = '10.00';
    //     $nonceFromTheClient = $request->data->nonceToken;

    //     $result = $this->gateway->transaction()->sale([
    //         'amount' => $amount,
    //         'paymentMethodNonce' => $nonceFromTheClient,
    //         'options' => [
    //             'submitForSettlement' => true
    //         ]
    //     ]);

    //     if ($result->success) {
    //         return response()->json([
    //             'success' => true,
    //             'transaction' => $result->transaction
    //         ]);
    //     } else {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $result->message
    //         ]);
    //     }
    // }
}
