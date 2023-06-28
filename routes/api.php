<?php

use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::post('/movies/', [MovieController::class, 'store'])->name('movies.store');
    Route::post('/movies/favorite', [MovieController::class, 'favorite'])->name('movies.favorite');
    Route::get('/movies/non-favorited-movies/{user}', [MovieController::class, 'nonFavoritedMovies'])->name('movies.non-favorited-movies');
});
