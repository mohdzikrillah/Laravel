<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{
    public function index() {
        $genres = Genre::all();

        if($genres->isEmpty()){
            return response()->json([
                "success"=>true,
                "messege" => "resource data not found"
            ], 200);
        }

        return response()->json([
            "success"=> true,
            "messege" => "Get all resource",
            "data" => $genres,
        ], 200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required|string|max:255"
        ]);

        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "messege" => $validator->errors()
            ], 400);
        }
        $genres = Genre::create([
            "name" => $request->name
        ]);

        return response()->json([
            "success" => true,
            "messege" => "resource created",
            "data" => $genres,
        ], 201);
    }

    //show
    public function show(string $id){
        $genre = Genre::find($id);

        if(!$genre){
            return response()->json([
                "success"=>false,
                "messege" => "resource not found"
            ], 404);
        }

        return response()->json([
            "success" => true,
            "messege" => "Get resource",
            "data" => $genre
        ]);
    }

    //update
    public function update(Request $request, string $id){
        //1, cari data
        $genre = Genre::find($id);
        if(!$genre){
            return response()->json([
                "success"=>false,
                "messege" => "resource not found"
            ], 404);
        }
        //2. validator
        $validator = Validator::make($request->all(),[
            "name" => "required|string|max:225"
        ]);

        if($validator->fails()){
            return response()->json([
                "success"=>false,
                "messege" => $validator->errors()
            ], 400);
        }
        //3 siapkan data yang mau diupdate
        $data = [
            "name" => $request->name,
        ];

        //4, update data
        $genre->update($data);
        return response()->json([
            "success" => true,
            "messege" => "resource updated",
            "data" => $genre
        ], 200);
    }
     //delete
     public function destroy(string $id){
        $genre = Genre::find($id);
        if(!$genre){
            return response()->json([
                "success"=>false,
                "messege" => "resourse not found"
            ], 404);
        }
        $genre->delete();
        return response() ->json([
            "success" =>true,
            "messege" => "resource deleted",
            "data" => $genre
        ], 200);
     }
}
