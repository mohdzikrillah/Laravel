<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres =[
        ['id' => 1, 'name' => 'Sejarah'],
        ['id' => 2, 'name' => 'Memoar'],
        ['id' => 3, 'name' => 'Fiksi Filosofis'],
        ['id' => 4, 'name' => 'Drama'],
        ['id' => 5, 'name' => 'Biografi'],
    ];
    public function getGenres(){
    return $this->genres;
}
}