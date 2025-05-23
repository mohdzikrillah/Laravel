<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AuthorController extends Controller
{
    public function index() {
        $authors=Author::all();

        if($authors->isEmpty()){
            return response()->json([
                "success" => true,
                "messege" => "resource data not found !"
            ], 200);
        }


        return response()->json([
            "success" => true,
            "messege" => "Get all resource",
            "data" => $authors
        ], 200);
    }

    public function store(Request $request){
        //1. validator
        $validator = FacadesValidator::make($request->all(),[
            "name" => "required|string|max:255",
            "profile" => "required|string|max:255"
        ]);
        //2. check validator eror
        if ($validator->fails()){
            return response()->json([
                "success"=> false,
                "messege" => $validator->errors()
            ], 422);
        };

        //insert data
        $authors = Author::create([
            "name" => $request->name,
            "profile" => $request->profile
        ]);

        return response()->json([
            "success" => true,
            "messege" => "resource created",
            "data" => $authors
        ], 201);
    }
}