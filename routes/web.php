<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public Routes
Route::resource('authors', AuthorController::class)->only(['index', 'show']);
Route::resource('books', BookController::class)->only(['index', 'show']);
Route::resource('genres', GenreController::class)->only(['index', 'show']);
Route::resource('publishers', PublisherController::class)->only(['index', 'show']);
Route::resource('stores', StoreController::class)->only(['index', 'show']);

// Admin Routes
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('authors', AuthorController::class)->except(['show']);
    Route::resource('books', BookController::class)->except(['show']);
    Route::resource('genres', GenreController::class)->except(['show']);
    Route::resource('publishers', PublisherController::class)->except(['show']);
    Route::resource('stores', StoreController::class)->except(['show']);
    Route::resource('users', UserController::class);

    // Other Resources
    Route::resource('distributors', DistributorController::class);
    Route::resource('promotions', PromotionController::class);
    Route::resource('user-types', UserTypeController::class);
    Route::resource('newsletters', NewsletterController::class);
    Route::resource('abouts', AboutController::class);
    Route::resource('contacts', ContactController::class);
});

require __DIR__.'/auth.php';

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{book}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/success', [CartController::class, 'success'])->name('cart.success');

