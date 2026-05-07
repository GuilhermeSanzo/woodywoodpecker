<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['id' => 1, 'name' => 'Administração'],
            ['id' => 2, 'name' => 'Artes'],
            ['id' => 3, 'name' => 'Autoajuda'],
            ['id' => 4, 'name' => 'Aventura'],
            ['id' => 5, 'name' => 'Biografias e Memórias'],
            ['id' => 6, 'name' => 'Ciências'],
            ['id' => 7, 'name' => 'Concurso Público'],
            ['id' => 8, 'name' => 'Contos e Crônicas'],
            ['id' => 9, 'name' => 'Dicionários e Manuais'],
            ['id' => 10, 'name' => 'Direito'],
            ['id' => 11, 'name' => 'Diversos'],
            ['id' => 12, 'name' => 'Economia'],
            ['id' => 13, 'name' => 'Ensaios'],
            ['id' => 14, 'name' => 'Ficção Científica'],
            ['id' => 15, 'name' => 'Ficção Fantástica'],
            ['id' => 16, 'name' => 'Ficção Suspense'],
            ['id' => 17, 'name' => 'Filosofia'],
            ['id' => 18, 'name' => 'Geografia'],
            ['id' => 19, 'name' => 'História'],
            ['id' => 20, 'name' => 'Humor'],
            ['id' => 21, 'name' => 'Infanto-Juvenil'],
            ['id' => 22, 'name' => 'Linguística'],
            ['id' => 23, 'name' => 'Medicina'],
            ['id' => 24, 'name' => 'Poesia'],
            ['id' => 25, 'name' => 'Policial'],
            ['id' => 26, 'name' => 'Psicologia'],
            ['id' => 27, 'name' => 'Regimes'],
            ['id' => 28, 'name' => 'Religião'],
            ['id' => 29, 'name' => 'Romance'],
            ['id' => 30, 'name' => 'Teoria e Crítica'],
            ['id' => 31, 'name' => 'Terror e Suspense'],
            ['id' => 32, 'name' => 'Turismo'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
