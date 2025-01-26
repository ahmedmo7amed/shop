<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return optional($item->product)->price * $item->quantity;
        });
        //dd($cartItems);

        return view('cart', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => $validated['quantity'],
            ]
        );

        return back()->with('success', 'Product added to cart successfully.');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->update(['quantity' => $validated['quantity']]);

        return back()->with('success', 'Cart updated successfully.');
    }

    public function remove(Product $product)
    {
        Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->delete();

        return back()->with('success', 'Item removed from cart successfully.');
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();

        return back()->with('success', 'Cart cleared successfully.');
    }
}
