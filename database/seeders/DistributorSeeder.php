<?php

namespace Database\Seeders;

use App\Models\Distributor;
use Illuminate\Database\Seeder;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $distributors = [
            ['id' => 1, 'name' => 'Entrega Livros'],
            ['id' => 2, 'name' => 'Books Express'],
        ];

        foreach ($distributors as $distributor) {
            Distributor::create($distributor);
        }
    }
}
