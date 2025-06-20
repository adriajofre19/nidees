<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        $products = Product::with(['category', 'images'])->get();
        $categories = Category::all();

        return Inertia::render('Home', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }
}
