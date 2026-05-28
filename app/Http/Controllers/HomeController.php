<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the application welcome page.
     */
    public function index()
    {
        $popularBooks = Book::with(['author', 'genre'])
            ->orderByDesc('views_count')
            ->take(8)
            ->get();

        $popularAuthors = Author::orderByDesc('views_count')
            ->take(6)
            ->get();

        return view('welcome', compact('popularBooks', 'popularAuthors'));
    }
}
