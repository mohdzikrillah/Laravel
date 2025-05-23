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
}
