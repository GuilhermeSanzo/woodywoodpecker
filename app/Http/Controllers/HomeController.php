<?php

namespace App\Http\Controllers;

use App\Models\BookOfTheMonth;
use App\Models\FeaturedAuthor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the application welcome page.
     */
    public function index()
    {
        $booksOfTheMonth = BookOfTheMonth::with(['book.genre'])
            ->where('is_active', true)
            ->get();

        $featuredAuthors = FeaturedAuthor::with(['author'])
            ->where('is_active', true)
            ->get();

        return view('welcome', compact('booksOfTheMonth', 'featuredAuthors'));
    }
}
