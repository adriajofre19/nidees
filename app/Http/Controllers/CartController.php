<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;

use Illuminate\Support\Str;
use Illuminate\Http\Response;

class CartController extends Controller
{

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


public function add(Request $request)
{
    // Obtener guest_id de la cookie o crear uno nuevo
    $guestId = $request->cookie('guest_id');
    
    if (!$guestId) {
        $guestId = Str::uuid()->toString();
    }
    
    $request->validate([
        'product_id' => 'required|exists:products,id',
    ]);

    $userId = auth()->id();

    // Aquí buscar carrito según user_id o guest_id
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
            'guest_id' =>  $guestId,
            'product_id' => $request->product_id,
            'quantity' => 1,
        ]);
    }

    $response = back()->with('success', 'Producte afegit al carret.');

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
