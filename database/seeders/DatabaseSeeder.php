<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserTypeSeeder::class,
            AuthorSeeder::class,
            PublisherSeeder::class,
            GenreSeeder::class,
            DistributorSeeder::class,
            StoreSeeder::class,
            PromotionSeeder::class,
        ]);
    }
}
