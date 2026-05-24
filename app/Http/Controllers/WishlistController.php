<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Toggle the book in the user's wishlist.
     */
    public function toggle(Request $request, Book $book)
    {
        $request->user()->wishlist()->toggle($book->id);

        return back();
    }
}
