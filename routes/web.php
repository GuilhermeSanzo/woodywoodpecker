<?php

use App\Http\Controllers\ProfileController;
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
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('authors', AuthorController::class);
Route::resource('publishers', PublisherController::class);
Route::resource('genres', GenreController::class);
Route::resource('distributors', DistributorController::class);
Route::resource('promotions', PromotionController::class);
Route::resource('user-types', UserTypeController::class);
Route::resource('stores', StoreController::class);
Route::resource('newsletters', NewsletterController::class);
Route::resource('abouts', AboutController::class);
Route::resource('contacts', ContactController::class);
Route::resource('books', BookController::class);
Route::resource('users', UserController::class);

require __DIR__.'/auth.php';
