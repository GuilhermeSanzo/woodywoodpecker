<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                'id' => 1,
                'name' => 'Cidade1',
                'street_type' => 'Rua',
                'address' => 'Endereco1',
                'number' => '123',
                'neighborhood' => 'Bairro1',
                'city' => 'Cidade1',
                'state' => 'SP',
            ],
            [
                'id' => 3,
                'name' => 'Cidade2',
                'street_type' => 'Rua',
                'address' => 'Endereco2',
                'number' => '123',
                'neighborhood' => 'Bairro2',
                'city' => 'Cidade2',
                'state' => 'SP',
            ],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }
    }
}
