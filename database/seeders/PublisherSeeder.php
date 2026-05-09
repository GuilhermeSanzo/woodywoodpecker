<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $publishers = [
            ['id' => 1, 'name' => 'Martins'],
            ['id' => 2, 'name' => 'Saraiva'],
            ['id' => 3, 'name' => 'Cultura'],
        ];

        foreach ($publishers as $publisher) {
            Publisher::create($publisher);
        }
    }
}
