<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'Bumi Manusia',
            'description' => 'Novel sejarah Indonesia. Di dalamnya membahas mengenai pribumi yang dipermainkan oleh bangsa Belanda.',
            'price' => 70000,
            'stock' => 3000,
            'cover_photo' => 'bumi-manusia.jpg',
            'genre_id' => 1,
            'author_id' => 1
        ]);
        Book::create([
            'title' => 'Laut Bercerita',
            'description' => 'Mengangkat kisah aktivis yang hilang di masa Orde Baru dan perjuangan keluarganya mencari kebenaran.',
            'price' => 80000,
            'stock' => 1500,
            'cover_photo' => 'laut-bercerita.jpg',
            'genre_id' => 2,
            'author_id' => 2
        ]);
        Book::create([
            'title' => 'Supernova: Ksatria, Puteri dan Bintang Jatuh',
            'description' => 'Sebuah eksplorasi filsafat, cinta, dan ilmu pengetahuan dalam kisah yang penuh teka-teki.',
            'price' => 85000,
            'stock' => 2000,
            'cover_photo' => 'supernova.jpg',
            'genre_id' => 3,
            'author_id' => 3
        ]);
        Book::create([
            'title' => 'Pulang',
            'description' => 'Novel tentang eksil politik Indonesia dan pencarian identitas setelah tragedi 1965.',
            'price' => 78000,
            'stock' => 1800,
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 4,
            'author_id' => 4
        ]);
        Book::create([
            'title' => '9 Summers 10 Autumns',
            'description' => 'Kisah nyata anak sopir angkot dari Batu yang menembus dunia kerja di New York.',
            'price' => 73000,
            'stock' => 1200,
            'cover_photo' => '9s10a.jpg',
            'genre_id' => 5,
            'author_id' => 5
        ]);
    }
}