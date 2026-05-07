<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['id' => 1, 'name' => 'Administrador'],
            ['id' => 2, 'name' => 'Operador'],
            ['id' => 3, 'name' => 'Cataloguista'],
        ];

        foreach ($types as $type) {
            UserType::create($type);
        }
    }
}
