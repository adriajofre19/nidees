<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['category', 'images'])->get();

        $user = Auth::User();

        return Inertia::render('Shop/Index', [
            'products' => $products,
            'user' => $user
        ]);
    }
}
