<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// Landing page untuk guest, redirect ke movies.index kalau sudah login
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('movies.index');
    }
    return view('landing');
})->name('landing');

Route::get('/movies', [MovieController::class, 'index'])
    ->name('movies.index');

Route::get('/movies/{movie}', [MovieController::class, 'show'])
    ->name('movies.show');

Route::middleware('auth')->group(function () {

    Route::get('/movies/create', [MovieController::class, 'create'])
        ->name('movies.create');

    Route::post('/movies', [MovieController::class, 'store'])
        ->name('movies.store');

    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])
        ->name('movies.edit');

    Route::put('/movies/{movie}', [MovieController::class, 'update'])
        ->name('movies.update');

    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])
        ->name('movies.destroy');
});

require __DIR__.'/auth.php';