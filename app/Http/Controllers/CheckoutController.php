<?php

namespace App\Http\Controllers;

use App\Repositories\CartRepository;
use Error;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Stripe\Exception\ApiErrorException;

class CheckoutController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('checkout.create');
    }

    /**
     * @return void
     * @throws ApiErrorException
     */
    public function paymentIntent()
    {
        \Stripe\Stripe::setApiKey(config('stripe.test_secret_key'));

        header('Content-Type: application/json');

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);

            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => (new CartRepository())->total(),
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                "metadata" => [
                    "order_items" => (new CartRepository())->jsonOrderItems()
                ]
            ]);

            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];

            echo json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
