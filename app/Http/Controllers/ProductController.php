<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage; // Añadir arriba
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(['category', 'images'])->get();

        return Inertia::render('Products/Index', [
            'products' => $products,
        ]);
    }


    public function create()
    {
        $categories = Category::all();

        return Inertia::render('Products/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:products',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|array',
        'image.*' => 'image|max:2048',
    ]);

    $slug = $request->slug ?: Str::slug($request->name);

    // Crear el producto
    $product = Product::create([
        'name' => $request->name,
        'slug' => $slug,
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
    ]);

    // Guardar imágenes si existen
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $img) {
            $path = $img->store('images/products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
            ]);
        }
    }

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images'); // Cargar imágenes relacionadas

        return Inertia::render('Products/Edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    public function product(Product $product)
    {
        $product->load(['category', 'images']); // Cargar relaciones

        // Obtener los productos de la misma categoría, excluyendo el actual
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('images','category')
            ->get();


        return Inertia::render('Shop/Show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|exists:categories,id',
        'images.*' => 'nullable|image|max:2048', // nuevas imágenes
        'removed_images' => 'nullable|array',
        'removed_images.*' => 'integer|exists:product_images,id',
    ]);

    $slug = $request->slug ?: Str::slug($request->name);

    // Actualizar producto
    $product->update([
        'name' => $request->name,
        'slug' => $slug,
        'description' => $request->description,
        'price' => $request->price,
        'category_id' => $request->category_id,
    ]);

    // ✅ 1. Eliminar imágenes marcadas
    if ($request->has('removed_images')) {
        $imagesToDelete = ProductImage::whereIn('id', $request->removed_images)->get();

        foreach ($imagesToDelete as $img) {
            Storage::disk('public')->delete($img->path); // Borra del disco
            $img->delete(); // Borra de la base de datos
        }
    }

    // ✅ 2. Subir nuevas imágenes
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $path = $img->store('images/products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
            ]);
        }
    }

    return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
}

    public function destroy(Product $product)
    {
        // Eliminar la imatge si existeix
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
