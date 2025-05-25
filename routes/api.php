<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/books', BookController::class);
Route::apiResource('/genres', GenreController::class);
Route::apiResource('/authors', AuthorController::class);

// //get
// Route::get('/books', [BookController::class,'index']);
// Route::get('/genres', [GenreController::class,'index']);
// Route::get('/authors', [AuthorController::class,'index']);
// Route::get('/books/{id}',[BookController::class,'show']);
// Route::get('/genres/{id}',[GenreController::class,'show']);
// Route::get('/authors/{id}',[AuthorController::class,'show']);

// //post
// Route::post('/books', [BookController::class,'store']);
// Route::post('/genres', [GenreController::class,'store']);
// Route::post('/authors', [AuthorController::class,'store']);
// Route::post('/books/{id}', [BookController::class,'update']);
// Route::post('/genres/{id}', [GenreController::class,'update']);
// Route::post('/authors/{id}', [AuthorController::class,'update']);

// //delete
// Route::delete('/books/{id}', [BookController::class,'destroy']);
// Route::delete('/genres/{id}', [GenreController::class,'destroy']);
// Route::delete('/authors/{id}', [AuthorController::class,'destroy']);


