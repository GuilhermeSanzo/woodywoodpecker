<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Publisher;
use App\Models\Store;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display search results for books, authors, genres, publishers, and stores.
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

        $genres = Genre::where('name', 'LIKE', "%{$query}%")
            ->with('books')
            ->get();

        $publishers = Publisher::where('name', 'LIKE', "%{$query}%")
            ->with('books')
            ->get();

        $stores = Store::where('name', 'LIKE', "%{$query}%")
            ->orWhere('city', 'LIKE', "%{$query}%")
            ->orWhere('neighborhood', 'LIKE', "%{$query}%")
            ->get();

        return view('search.results', compact('books', 'authors', 'genres', 'publishers', 'stores', 'query'));
    }
}
