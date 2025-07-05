<?php

namespace App\Http\Controllers;

use App\Models\CartItem;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

class CartController extends Controller
{
    public function index(Request $request)
{
    $userId = auth()->id();

    $items = CartItem::with(['product.images'])
        ->where('user_id', $userId)
        ->get();

    return Inertia::render('Cart/Index', [
        'items' => $items,
    ]);
}


    public function add(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $userId = auth()->id();

    $cartItem = CartItem::where('user_id', $userId)
        ->where('product_id', $request->product_id)
        ->first();

    if ($cartItem) {
        $cartItem->increment('quantity');
    } else {
        CartItem::create([
            'user_id' => $userId,
            'product_id' => $request->product_id,
            'quantity' => 1,
        ]);
    }

    return back()->with('success', 'Producte afegit al carret.');
}

public function remove(CartItem $cartItem)
{
    if ($cartItem->user_id === auth()->id()) {
        $cartItem->delete();
    }

    return back()->with('success', 'Producte eliminat del carret.');
}

public function increment(CartItem $cartItem)
{
    if ($cartItem->user_id === auth()->id()) {
        $cartItem->increment('quantity');
    }

    return back();
}

public function decrement(CartItem $cartItem)
{
    if ($cartItem->user_id === auth()->id() && $cartItem->quantity > 1) {
        $cartItem->decrement('quantity');
    }

    return back();
}

}
