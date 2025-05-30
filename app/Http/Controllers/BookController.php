<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index() {
        $books = Book::with('genre','author')->get();

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
                "message" => $validator->errors()
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
            "stock" => $request->stock,
            "cover_photo" => $image->hashName(),
            "genre_id" => $request->genre_id,
            "author_id" => $request->author_id,
        ]);

        //5. response
        return response()->json([
            "success"=> true,
            "message" => "resource add successfully!",
            "data" => $book
        ],201);
    }

    //show
    public function show(string $id){
        $book = Book::with('genre','author')-> find($id);

        if (!$book){
            return response()->json([
                "success" => false,
                "message" => "resource not found",
            ]);
        }
        return response()->json([
            "success" => true,
            "message" => "get detail resource",
            "data" => $book
        ]);
    }

    //update
    public function update(string $id, Request $request){
        //mencari data
        $book = Book::find($id);
        if (! $book){
            return response()->json([
                "success" => false,
                "message" => "resourse not found"
            ], 404);
        }
        // 2 validator
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'genre_id' => 'required|exists:genres,id',
            'author_id' => 'required|exists:authors,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
            "success" => false,
            "message" => $validator->errors()
        ], 422);
        }
        
        //3 siapkan data yang mau diupdate
        $data= [
            "title" => $request->title,
            "description" => $request->description,
            "price" => $request->price,
            "stock" => $request->stock,
            "genre_id" => $request->genre_id,
            "author_id" => $request->author_id,
        ];
        //4 handle image(uapload atau delete)
        if ($request->cover_photo){
            $image = $request->file('cover_photo');
            $image->store('books', 'public');


            if($book->cover_photo){
                FacadesStorage::disk('public')->delete('books/'.$book->cover_photo);
            }
            $data['cover_photo'] =$image->hashName();
        }

        //5. update data
        $book->update($data);
        return response()->json([
            "success" => true,
            "message" => "resourse updated successfully",
            "data" => $book
        ]);

    
    }


    //delete
    public function destroy(string $id){
        $book = Book::find($id);
        if (!$book){
            return response()->json([
                "success" => true,
                "messege" => "resourse not found",
            ]);
        }
        if ($book ->cover_photo){
            FacadesStorage::disk('public')->delete('books/'.$book->cover_photo);
        }

        $book ->delete();
        return response()->json([
            "success" => true,
            "messege" => "resourse deleted successfully",
        ]);
        }
}