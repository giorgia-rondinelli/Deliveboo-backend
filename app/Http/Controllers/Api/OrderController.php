<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Dish;
use Illuminate\Http\Request;
use Braintree\Gateway;
use App\functions\Helper;

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
            //popoliamo orders
            $newOrder = new Order();
            $newOrder->name = $request->input('name');
            $newOrder->slug = Helper::generateSlug($newOrder->name, Order::class);
            $newOrder->phone_number = $request->input('telefon');
            $newOrder->e_mail = $request->input('mail');
            $newOrder->address = $request->input('address');
            $newOrder->total_price = $request->input('subTotal');

            $newOrder->save();
            //popoliamo orders

            //popoliamo dish_orders
            $cart = $request->input('cart');
            $id = false;
            $quantity = 0;
            $orderId = Order::where('slug', $newOrder->slug)->first()->id;

            foreach ($cart as $cartItem) {
                if ($cartItem['id'] == $id) {
                    // Se il piatto è già presente, incrementa la quantità
                    $quantity++;
                } else {
                    if ($id !== false) {
                        // Recupera il piatto dal database
                        $dish = Dish::where('id', $id)->first();

                        // Aggiungi l'ordine con la quantità al piatto
                        $dish->orders()->attach($orderId, ['dish_quantity' => $quantity]);
                    }

                    // Imposta la nuova quantità e salva l'ID del piatto corrente
                    $quantity = 1; // reset quantity for the new dish
                    $id = $cartItem['id'];
                }
            }

            // Per gestire l'ultimo piatto nel carrello
            if ($id !== false) {
                $dish = Dish::where('id', $id)->first();
                $dish->orders()->attach($orderId, ['dish_quantity' => $quantity]);
            }
            //popoliamo dish_orders

            //ivio e-mail

            //ivio e-mail

            return response()->json([
                'success' => true,
                'transaction' => $result->transaction
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $result->message
            ]);
        }
    }
}
