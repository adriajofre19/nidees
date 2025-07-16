<?php

// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\CartItem;
use Illuminate\Support\Facades\Cookie;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        Stripe::setApiKey(config('cashier.secret'));

        $lineItems = collect($request->items)->map(function ($item) {
    return [
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
                'name' => $item['name'],
                'images' => [$item['image']], // URL pública
            ],
            'unit_amount' => intval($item['price'] * 100),
        ],
        'quantity' => $item['quantity'],
    ];
})->toArray();


        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.success'),
            'cancel_url' => route('checkout.cancel'),
        ]);

        return response()->json(['url' => $session->url]);
    }

    public function success(Request $request)
    {
        $user = Auth::user();
        $guestId = $request->cookie('guest_id');

        if ($user) {
            $user->cartItems()->delete(); // Elimina tots els productes del carret
        } elseif ($guestId) {
            // Elimina els productes del carret del visitant
            CartItem::where('guest_id', $guestId)->delete();
        }

        return Inertia::render('Checkout/Success');
    }

    public function cancel(Request $request)
    {
        return Inertia::render('Checkout/Cancel');
    }
}
