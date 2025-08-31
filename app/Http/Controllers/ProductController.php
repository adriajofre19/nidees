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
        'ca_description' => 'nullable|string', // nuevo campo
        'en_description' => 'nullable|string', // nuevo campo
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
        'ca_description' => $request->ca_description, // nuevo campo
        'en_description' => $request->en_description, // nuevo campo
        'price' => $request->price,
        'category_id' => $request->category_id,
    ]);

    // Guardar imágenes si existen
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $img) {
            $imageName = time() . '_' . $img->getClientOriginalName();
            $img->move(public_path('images/products'), $imageName);
            $path = 'images/products/' . $imageName;

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
    // Cargar relaciones del producto actual
    $product->load(['category', 'images']);

    // Buscar productes relacionats (mateixa categoria, excloent l'actual)
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->with(['images', 'category'])
        ->get();

    // Comptar quants relacionats tenim
    $count = $relatedProducts->count();

    // Si hi ha 3 o més, agafem 3 aleatoris d'aquests
    if ($count >= 4) {
        $relatedProducts = $relatedProducts->random(4);
    } else {
        // Ens faltaran alguns productes: quants?
        $needed = 4 - $count;

        // Agafem productes aleatoris excloent l'actual i els ja agafats
        $randomProducts = Product::where('id', '!=', $product->id)
            ->when($count > 0, function ($query) use ($relatedProducts) {
                return $query->whereNotIn('id', $relatedProducts->pluck('id'));
            })
            ->with(['images', 'category'])
            ->inRandomOrder()
            ->take($needed)
            ->get();

        // Afegim els aleatoris als relacionats
        $relatedProducts = $relatedProducts->concat($randomProducts);
    }

    // Retornar la vista amb el producte i els relacionats
    return Inertia::render('Shop/Show', [
        'product' => $product,
        'relatedProducts' => $relatedProducts,
    ]);
}

public function category(Category $category)
{
    $products = Product::where('category_id', $category->id)->get();
    
    return Inertia::render('Shop/Category', [
        'products' => $products,
        'category' => $category,
    ]);
}


    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
        'description' => 'nullable|string',
        'ca_description' => 'nullable|string', // nuevo campo
        'en_description' => 'nullable|string', // nuevo campo
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
        'ca_description' => $request->ca_description, // nuevo campo
        'en_description' => $request->en_description, // nuevo campo
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
            $imageName = time() . '_' . $img->getClientOriginalName();
            $img->move(public_path('images/products'), $imageName);
            $path = 'images/products/' . $imageName;

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
