<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [1, 'O Hobbit', '', 'Numa toca no chão, vivia um hobbit...', 'Arquivos/o_hobbit.jpg', 2, 31, 2, 3, 20.10],
            [2, 'O Senhor dos Anéis', 'A Sociedade do Anel', '...', 'Arquivos/o_senhor_dos_aneis_1.jpg', 2, 31, 2, 3, 10.23],
            [3, 'O Senhor dos Anéis', 'As Duas Torres', '...', 'Arquivos/o_senhor_dos_aneis_2.jpg', 2, 17, 2, 2, 50.20],
            [4, 'O Senhor dos Anéis', 'O Retorno do Rei', '...', 'Arquivos/o_senhor_dos_aneis_3.jpg', 2, 21, 2, 2, 30.00],
            [5, 'O Silmarillion', '', '...', 'Arquivos/o_silmarillion.jpg', 2, 32, 2, 3, 40.00],
            [6, 'Contos Inacabados', '', '...', 'Arquivos/contos_inacabados.jpg', 2, 30, 2, 3, 34.00],
            [7, 'As Aventuras de Tom Bombadil', '', '...', 'Arquivos/as_aventuras_de_tom_bombadil.jpg', 2, 30, 2, 3, 46.00],
            [8, 'A Última Canção de Bilbo', '', '...', 'Arquivos/a_ultima_cancao_de_bilbo.jpg', 2, 30, 2, 3, 46.00],
            [9, 'Harry Potter', 'E a Pedra Filosofal', '...', 'Arquivos/harry_potter_1.jpg', 3, 30, 2, 3, 36.39],
            [10, 'Harry Potter', 'E a Câmara Secreta', '...', 'Arquivos/harry_potter_2.jpg', 3, 30, 2, 3, 39.00],
            [11, 'Harry Potter', 'E o Prisioneiro de Askaban', '...', 'Arquivos/harry_potter_3.jpg', 3, 30, 2, 3, 30.00],
            [12, 'Harry Potter', 'E o Cálice de Fogo', '...', 'Arquivos/harry_potter_4.jpg', 3, 30, 2, 3, 30.00],
            [13, 'Harry Potter', 'E a Ordem da Fenix', '...', 'Arquivos/harry_potter_5.jpg', 3, 30, 2, 3, 30.00],
            [14, 'Harry Potter', 'E o Enigma do Príncipe', '...', 'Arquivos/harry_potter_6.jpg', 3, 30, 2, 3, 30.00],
            [15, 'Harry Potter', 'E as Relíquias da Morte', '...', 'Arquivos/harry_potter_7.jpg', 3, 30, 2, 3, 30.00],
            [16, 'As Crônicas de Nárnia', 'O Leão, a Feiticeira e o Guarda-Roupa', '...', 'Arquivos/as_cronicas_de_narnia_1.jpg', 19, 30, 2, 3, 30.00],
            [17, 'As Crônicas de Nárnia', 'Príncipe Caspian', '...', 'Arquivos/as_cronicas_de_narnia_2.jpg', 19, 30, 2, 3, 30.00],
            [18, 'As Crônicas de Nárnia', 'A Viagem do Peregrino da Alvorada', '...', 'Arquivos/as_cronicas_de_narnia_3.jpg', 19, 30, 2, 3, 30.00],
            [19, 'As Crônicas de Nárnia', 'A Cadeira de Prata', '...', 'Arquivos/as_cronicas_de_narnia_4.jpg', 19, 30, 2, 3, 30.00],
            [20, 'As Crônicas de Nárnia', 'O Cavalo e seu Menino', '...', 'Arquivos/as_cronicas_de_narnia_5.jpg', 19, 30, 2, 3, 30.00],
            [21, 'As Crônicas de Nárnia', 'O Sobrinho do Mago', '...', 'Arquivos/as_cronicas_de_narnia_6.jpg', 19, 30, 2, 3, 30.00],
            [22, 'As Crônicas de Nárnia', 'A Última Batalha', '...', 'Arquivos/as_cronicas_de_narnia_7.jpg', 19, 30, 2, 3, 30.00],
        ];

        foreach ($books as $book) {
            Book::create([
                'id' => $book[0],
                'title' => $book[1],
                'subtitle' => $book[2],
                'description' => $book[3],
                'image' => $book[4],
                'author_id' => $book[5],
                'genre_id' => $book[6],
                'distributor_id' => $book[7],
                'publisher_id' => $book[8],
                'price' => $book[9],
            ]);
        }
    }
}
