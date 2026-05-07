<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'id' => 2,
                'name' => 'John Ronald Reuel Tolkien',
                'pseudonym' => 'J.R.R. Tolkien',
                'image' => 'Arquivos/Tolkien.jpg',
                'birth_date' => '1970-01-01',
                'death_date' => '1973-09-02',
                'description' => '...',
            ],
            [
                'id' => 3,
                'name' => 'Joanne Rowling',
                'pseudonym' => 'J.K. Rowling',
                'image' => 'Arquivos/J_K_Rowling.jpg',
                'birth_date' => '1965-07-31',
                'death_date' => null,
                'description' => '...',
            ],
            [
                'id' => 4,
                'name' => 'Joaquim Maria Machado de Assis',
                'pseudonym' => 'Machado de Assis',
                'image' => 'Arquivos/machado_de_assis.jpg',
                'birth_date' => '1970-01-01',
                'death_date' => '1908-09-29',
                'description' => '...',
            ],
            [
                'id' => 5,
                'name' => 'George Raymond Richard Martin',
                'pseudonym' => 'George R.R. Martin',
                'image' => 'Arquivos/George_R_R_Martin.jpg',
                'birth_date' => '1948-09-20',
                'death_date' => null,
                'description' => '...',
            ],
            [
                'id' => 6,
                'name' => 'Clarice Lispector',
                'pseudonym' => 'Clarice Lispector',
                'image' => 'Arquivos/clarice_lispector.jpg',
                'birth_date' => '1920-12-10',
                'death_date' => '1977-12-09',
                'description' => '...',
            ],
            [
                'id' => 7,
                'name' => 'Jorge Amado',
                'pseudonym' => 'Jorge Amado',
                'image' => 'Arquivos/jorge_amado.jpg',
                'birth_date' => '1908-08-10',
                'death_date' => '2001-08-06',
                'description' => '...',
            ],
            [
                'id' => 10,
                'name' => 'Carlos Drummond de Andrade',
                'pseudonym' => 'Carlos Drummond de Andrade',
                'image' => 'Arquivos/carlos_drummond_de_andrade.jpg',
                'birth_date' => '1902-10-31',
                'death_date' => '1987-08-17',
                'description' => '...',
            ],
            [
                'id' => 15,
                'name' => 'Fernando Pessoa',
                'pseudonym' => 'Fernando Pessoa',
                'image' => 'Arquivos/fernando_pessoa.jpg',
                'birth_date' => '1970-01-01',
                'death_date' => '1935-12-30',
                'description' => '...',
            ],
            [
                'id' => 19,
                'name' => 'Clive Staples Lewis',
                'pseudonym' => 'C.S. Lewis',
                'image' => 'Arquivos/C_S_Lewis.jpg',
                'birth_date' => '1970-01-01',
                'death_date' => '1963-11-22',
                'description' => '...',
            ],
            [
                'id' => 20,
                'name' => 'Gilbert Keith Chesterton',
                'pseudonym' => 'G.K. Chesterton',
                'image' => 'Arquivos/chesterton.jpg',
                'birth_date' => '1970-01-01',
                'death_date' => '1936-06-14',
                'description' => '...',
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
