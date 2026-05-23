<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart contents.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'totalAmount'));
    }

    /**
     * Process the checkout and create an order.
     */
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        $order = \App\Models\Order::create([
            'user_id' => auth()->id() ?? 1,
            'total_amount' => $totalAmount,
            'status' => 'completed',
        ]);

        foreach ($cart as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
            ]);

            // Update book stock
            $book = \App\Models\Book::find($item['id']);
            if ($book) {
                $book->decrement('stock', $item['quantity']);
            }
        }

        session()->forget('cart');

        return redirect()->route('cart.success', ['order' => $order->id]);
    }

    /**
     * Display the success page after checkout.
     */
    public function success(Request $request)
    {
        $orderId = $request->get('order');
        return view('cart.success', compact('orderId'));
    }

    /**
     * Add a book to the shopping cart.
     */
    public function add(Request $request, Book $book)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            $cart[$book->id]['quantity']++;
        } else {
            $cart[$book->id] = [
                'id' => $book->id,
                'title' => $book->title,
                'price' => $book->price,
                'quantity' => 1,
                'image' => $book->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Book added to cart: ' . $book->title);
    }
}
