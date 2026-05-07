<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [1, 'guilherme@email.com', 'guilherme', 'emrehliug', 'Guilherme Santos Souza', 1, 'Arquivos/Tolkien.jpg'],
            [2, 'vinicius@email.com', 'vinicius', '1234', 'Vinicius Santos Souza', 2, 'Arquivos/J_K_Rowling.jpg'],
            [3, 'mateus@email.com', 'mateus', '1234', 'Mateus Ferreira Morelli', 2, 'Arquivos/J_K_Rowling.jpg'],
            [4, 'lucas@email.com', 'lucas', '1234', 'Lucas Augusto dos Santos', 2, 'Arquivos/C_S_Lewis.jpg'],
            [6, 'zaqueu@python.com', 'zaqueu', '1234', 'Zaqueu Moreira da Silva Júnior', 3, ''],
            [8, 'djeison@email.com', 'djeison', '1234', 'Djeison', 3, ''],
            [10, 'emrehliug@email.com', 'emrehliug', '1234', 'Emrehliug', 1, 'Arquivos/Tolkien.jpg'],
            [11, 'cornelius@email.com', 'cornelius', '1234', 'Cornelius', 1, 'Arquivos/Tolkien.jpg'],
        ];

        foreach ($users as $user) {
            User::create([
                'id' => $user[0],
                'email' => $user[1],
                'username' => $user[2], // Mapping legacy 'login' to 'username'
                'name' => $user[4],
                'password' => Hash::make($user[3]),
                'user_type_id' => $user[5],
                'image' => $user[6],
            ]);
        }
    }
}
