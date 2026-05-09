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
            ['id' => 4, 'name' => 'Cliente'],
        ];

        foreach ($types as $type) {
            UserType::updateOrCreate(['id' => $type['id']], $type);
        }
    }
}
