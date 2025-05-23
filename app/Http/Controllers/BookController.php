<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index() {
        $books = Book::all();

        if ($books->isEmpty()){
            return response()->json([
                "success"=> true,
                "messege" => "resource data not found"
            ], 200);
        }
        return response()->json([
            "success"=> true,
            "messege" => "Get all resource",
            "data" => $books,
        ], 300);
    }
    public function store(Request $request){
        //1 validator
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'cover_photo' => 'required|image|mimes:jpeg.png,jpg|max:2048',
            'genre_id' => 'required|integer|exists:genres,id',
            'author_id' => 'required|integer|exists:authors,id'
        ]);

        //2. check validator eror
        if ($validator->fails()){
            return response()->json([
                "success"=> false,
                "meddege" => $validator->errors()
            ], 422);
        };
        //3. upload image
        $image = $request->file("cover_photo");
        $image ->store('books', 'public');
        
        //4. insert data
        $book = Book::create([
            "title" => $request->title,
            "description" => $request->description,
            "price" => $request->price,
            "stock" => $request->stock??0,
            "cover_photo" => $image->hashName(),
            "genre_id" => $request->genre_id,
            "author_id" => $request->author_id,
        ]);

        //5. response
        return response()->json([
            "success"=> true,
            "messege" => "resource add successfully!",
            "data" => $book
        ],201);
    }

}