<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use App\Models\CartItem;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Models\ProductImage;

class CartController extends Controller
{
    public function index2(Request $request)
{
    $userId = auth()->id();

    $items = CartItem::with(['product.images'])
        ->where('user_id', $userId)
        ->get();

    return Inertia::render('Cart/Index', [
        'items' => $items,
    ]);
}

public function index(Request $request)
{
    $userId = auth()->id();
    $guestId = $request->cookie('guest_id');

    $itemsQuery = CartItem::with(['product.images']);

    if ($userId) {
        $itemsQuery->where('user_id', $userId);
    } elseif ($guestId) {
        $itemsQuery->where('guest_id', $guestId);
    } else {
        $itemsQuery->whereNull('user_id')->whereNull('guest_id'); // carrito vacío
    }

    $items = $itemsQuery->get();

    return Inertia::render('Cart/Index', [
        'items' => $items,
    ]);
}


    public function add2(Request $request)
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

public function add(Request $request)
{
    $guestId = $request->cookie('guest_id');
    
    $newGuestId = false;
    if (!$guestId) {
        $guestId = Str::uuid()->toString();
        $newGuestId = true;
    }

    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $userId = auth()->id();

    $cartItemQuery = CartItem::where('product_id', $request->product_id);

    if ($userId) {
        $cartItemQuery->where('user_id', $userId);
    } else {
        $cartItemQuery->where('guest_id', $guestId);
    }

    $cartItem = $cartItemQuery->first();

    if ($cartItem) {
        $cartItem->increment('quantity');
    } else {
        CartItem::create([
            'user_id' => $userId,
            'guest_id' => $guestId,
            'product_id' => $request->product_id,
            'quantity' => 1,
        ]);
    }

    $response = back()->with('success', 'Producte afegit al carret.');

    // ✅ Añadir la cookie solo si es nueva
    if ($newGuestId) {
        $cookie = cookie('guest_id', $guestId, 60 * 24 * 30); // 30 días
        return $response->withCookie($cookie);
    }

    return $response;
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
