<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display search results for books and authors.
     */
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return redirect()->back();
        }

        $books = Book::where('title', 'LIKE', "%{$query}%")
            ->orWhere('subtitle', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with(['author', 'genre'])
            ->get();

        $authors = Author::where('name', 'LIKE', "%{$query}%")
            ->orWhere('pseudonym', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with('books')
            ->get();

        return view('search.results', compact('books', 'authors', 'query'));
    }
}
