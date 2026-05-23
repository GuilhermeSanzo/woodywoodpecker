<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display the authenticated user's order history.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id() ?? 1)
            ->with('items.book')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('orders.index', compact('orders'));
    }
}
