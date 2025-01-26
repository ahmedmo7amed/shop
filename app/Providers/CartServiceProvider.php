<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share cart data with the header view
        View::composer('partials.header', function ($view) {
            if (Auth::check()) {
                $cartItems = Auth::user()->carts()->with('product')->get();
                $total = $cartItems->sum(function ($item) {
                    return optional($item->product)->price * $item->quantity;
                });
            } else {
                $cartItems = collect();
                $total = 0;
            }

            $view->with('cartItems', $cartItems)->with('total', $total);
        });
    }
}
