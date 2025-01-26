<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderHistory;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index(Order $order)
    {
        return view('order-histories.index', [
            'histories' => $order->histories()->latest()->paginate(10),
            'order' => $order,
        ]);
    }

    public function store(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        $order->histories()->create([
            ...$validated,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Order history added successfully.');
    }
}
