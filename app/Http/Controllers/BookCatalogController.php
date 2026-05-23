<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookCatalogController extends Controller
{
    /**
     * Display the public book catalog.
     */
    public function index()
    {
        $books = Book::with(['author', 'genre', 'publisher'])->get();

        return view('books.index', compact('books'));
    }
}
