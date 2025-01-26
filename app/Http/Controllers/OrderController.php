<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function history()
    {
        $orders = auth()->user()->orders()
            ->with(['items.product'])
            ->latest()
            ->paginate(10);

        return view('order-history', compact('orders'));
    }

    public function invoice(Order $order)
    {
        // Make sure the user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('invoice-template', compact('order'));
    }
}
