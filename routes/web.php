<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FiraController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PrivacyController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\User;

use App\Http\Middleware\AdminMiddleware;

use Laravel\Socialite\Facades\Socialite;


use App\Http\Controllers\CheckoutController;

Route::post('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');


Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();

    $userExists = User::where('external_id', $user->id)->first();

    if($userExists) {
        Auth::login($userExists);
    } else {
        $newUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'external_id' => $user->id,
            'avatar' => $user->avatar,
        ]);

        Auth::login($newUser);
    }

    return redirect('/');
 
});

// Espanol
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tienda', [ShopController::class, 'index'])->name('shop.index');
Route::get('/nosotros', [FiraController::class, 'index'])->name('nosotros.index');
Route::get('/shop/{product}', [ProductController::class, 'product'])->name('product.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::get('/privacidad', [PrivacyController::class, 'index'])->name('privacy-policy.index');
Route::get('/cookies', [PrivacyController::class, 'cookies'])->name('cookies.index');
Route::get('/legal', [PrivacyController::class, 'legal'])->name('legal.index');
Route::get('/terminos', [PrivacyController::class, 'terms'])->name('terms.index');

// Catalan
Route::prefix('ca')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/tienda', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/nosotros', [FiraController::class, 'index'])->name('nosotros.index');
    Route::get('/shop/{product}', [ProductController::class, 'product'])->name('product.show');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/privacidad', [PrivacyController::class, 'index'])->name('privacy-policy.index');
    Route::get('/cookies', [PrivacyController::class, 'cookies'])->name('cookies.index');
    Route::get('/legal', [PrivacyController::class, 'legal'])->name('legal.index');
    Route::get('/terminos', [PrivacyController::class, 'terms'])->name('terms.index');
});

// English
Route::prefix('en')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/tienda', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/nosotros', [FiraController::class, 'index'])->name('nosotros.index');
    Route::get('/shop/{product}', [ProductController::class, 'product'])->name('product.show');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/privacidad', [PrivacyController::class, 'index'])->name('privacy-policy.index');
    Route::get('/cookies', [PrivacyController::class, 'cookies'])->name('cookies.index');
    Route::get('/legal', [PrivacyController::class, 'legal'])->name('legal.index');
    Route::get('/terminos', [PrivacyController::class, 'terms'])->name('terms.index');
});



Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
});

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::post('/nosotros', [FiraController::class, 'store'])->name('fires.store');
    Route::delete('/nosotros/{fire}', [FiraController::class, 'destroy'])->name('fires.destroy');
});


Route::get('/shop/{product}', [ProductController::class, 'product'])->name('product.show');

Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increment/{cartItem}', [CartController::class, 'increment'])->name('cart.increment');
Route::post('/cart/decrement/{cartItem}', [CartController::class, 'decrement'])->name('cart.decrement');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


require __DIR__.'/auth.php';
