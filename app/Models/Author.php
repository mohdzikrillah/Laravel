<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
    [
        'id' => 1,
        'name' => 'Pramoedya Ananta Toer',
        'profile' => 'Sastrawan legendaris Indonesia yang dikenal karena karya-karya perjuangan dan sejarah seperti tetralogi Buru.'
    ],
    [
        'id' => 2,
        'name' => 'Leila S. Chudori',
        'profile' => 'Penulis dan jurnalis senior, terkenal dengan novel "Pulang" yang menggambarkan tragedi politik Indonesia.'
    ],
    [
        'id' => 3,
        'name' => 'Dewi Lestari',
        'profile' => 'Penulis, musisi, dan filsuf populer yang dikenal melalui seri novel Supernova yang memadukan sains dan spiritualitas.'
    ],
    [
        'id' => 4,
        'name' => 'Tere Liye',
        'profile' => 'Penulis produktif Indonesia dengan gaya khas menyentuh emosi, dikenal lewat karya-karya fiksi remaja dan sosial.'
    ],
    [
        'id' => 5,
        'name' => 'Iwan Setyawan',
        'profile' => 'Penulis inspiratif yang menulis dari kisah nyata kehidupannya, seperti dalam buku "9 Summers 10 Autumns".'
    ]
    ];
    
    public function getAuthors(){
        return $this->authors;
}
}