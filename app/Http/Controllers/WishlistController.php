<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist.
     */
    public function index()
    {
        $books = auth()->user()->wishlist;

        return view('wishlist.index', compact('books'));
    }

    /**
     * Toggle the book in the user's wishlist.
     */
    public function toggle(Request $request, Book $book)
    {
        $request->user()->wishlist()->toggle($book->id);

        return back();
    }
}
