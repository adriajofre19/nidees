<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $line_items = collect($request->cartItems)->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['product']['name'],
                    ],
                    'unit_amount' => intval($item['product']['price'] * 100),
                ],
                'quantity' => $item['quantity'],
            ];
        });

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items->toArray(),
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return response()->json(['id' => $session->id]);
    }

    public function success()
    {
        return inertia('CheckoutSuccess'); // tu vista Inertia para éxito
    }

    public function cancel()
    {
        return inertia('CheckoutCancelled'); // tu vista Inertia para cancelación
    }
}
