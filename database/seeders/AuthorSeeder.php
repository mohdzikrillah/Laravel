<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Pramoedya Ananta Toer',
            'profile' => 'Sastrawan legendaris Indonesia yang dikenal karena karya-karya perjuangan dan sejarah seperti tetralogi Buru.'
        ]);
        Author::create([
            'name' => 'Leila S. Chudori',
            'profile' => 'Penulis dan jurnalis senior, terkenal dengan novel "Pulang" yang menggambarkan tragedi politik Indonesia.'
        ]);
        Author::create([
            'name' => 'Dewi Lestari',
            'profile' => 'Penulis, musisi, dan filsuf populer yang dikenal melalui seri novel Supernova yang memadukan sains dan spiritualitas.'
        ]);
        Author::create([
            'name' => 'Tere Liye',
            'profile' => 'Penulis produktif Indonesia dengan gaya khas menyentuh emosi, dikenal lewat karya-karya fiksi remaja dan sosial.'
        ]);
        Author::create([
            'name' => 'Iwan Setyawan',
            'profile' => 'Penulis inspiratif yang menulis dari kisah nyata kehidupannya, seperti dalam buku "9 Summers 10 Autumns".'
        ]);
    }
}