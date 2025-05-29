<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransactionController;
use App\Models\Genre;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[AuthController::class,'register']); 
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware(['auth:api'])->group(function(){
    Route::apiResource('/books', BookController::class)->only(['show','store','update']);
    Route::apiResource('/genres', GenreController::class)->only(['show','store','update']);
    Route::apiResource('/authors', AuthorController::class)->only(['show','store','update']);
    Route::apiResource('/transactions', TransactionController::class)->only(['show','store','update']);

    Route::middleware(['role:admin'])->group(function(){
        Route::apiResource('/books', BookController::class)->only(['destroy', 'index']);
        Route::apiResource('/genres', GenreController::class)->only(['destroy', 'index']);
        Route::apiResource('/authors', AuthorController::class)->only(['destroy', 'index']);
        Route::apiResource('/transactions', TransactionController::class)->only(['destroy', 'index']);

    });
});

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


