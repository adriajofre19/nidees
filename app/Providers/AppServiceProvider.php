<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Illuminate\Support\Facades\Cookie;
use App\Models\CartItem;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        Inertia::share([
    'auth' => fn () => [
        'user' => Auth::user(),
    ],
    'cartCount' => function () {
        if (Auth::check()) {
            return Auth::user()->cartItems()->sum('quantity');
        } else {
            $guestId = Cookie::get('guest_id');
            if ($guestId) {
                return CartItem::where('guest_id', $guestId)->sum('quantity');
            }
        }

        
        

        return 0;
    },
]);
    }
}
