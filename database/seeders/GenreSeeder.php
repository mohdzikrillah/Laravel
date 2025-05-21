<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            "name"=> "Memoar"
        ]);
        Genre::create([
            "name"=> "Fiksi Filosofis"
        ]);
        Genre::create([
            "name"=> "Drama"
        ]);
        Genre::create([
            "name"=> "Biografi"
        ]);
    }
}
// ['id' => 1, 'name' => 'Sejarah'],
//         ['id' => 2, 'name' => 'Memoar'],
//         ['id' => 3, 'name' => 'Fiksi Filosofis'],
//         ['id' => 4, 'name' => 'Drama'],
//         ['id' => 5, 'name' => 'Biografi'],