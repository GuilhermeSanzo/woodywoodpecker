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
