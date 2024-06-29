<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return to_route('movies.index');
});

Route::resource('movies', MovieController::class)
    ->only(['index','show']);

Route::resource('movies.reviews',ReviewController::class)
    ->scoped(['review' => 'movie'])
    ->only(['create']);

Route::middleware('throttle:reviews')->group(function () {
Route::resource('movies.reviews',ReviewController::class)
->scoped(['review' => 'movie'])
->only(['store']);
});

// Route::post('/movies/{movies}/reviews',[ReviewController::class, 'store'])
// ->scoped(['review' => 'movie'])->name('movies.reviews.store');

// Route::('movies.reviews',ReviewController::class)
// ->scoped(['review' => 'movie'])
// ->only(['create','store']);