<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = "book"; 
    protected $fillable = [
        "title", "description", "price", "author", "cover_photo", "genre_id", "author_id"
    ];
}
