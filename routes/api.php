<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//get
Route::get('/books', [BookController::class,'index']);
Route::get('/genres', [GenreController::class,'index']);
Route::get('/authors', [AuthorController::class,'index']);

//post
Route::post('/books', [BookController::class,'store']);
Route::post('/genres', [GenreController::class,'store']);
Route::post('/authors', [AuthorController::class,'store']);