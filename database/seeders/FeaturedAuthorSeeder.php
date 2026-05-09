<?php

namespace Database\Seeders;

use App\Models\FeaturedAuthor;
use Illuminate\Database\Seeder;

class FeaturedAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $featuredAuthors = [
            [1, 15, 1],
            [2, 6, 1],
            [3, 2, 1],
            // [4, 0, 0], // Skipping invalid author ID 0
            [5, 15, 1],
            [6, 10, 1],
            [7, 5, 1],
        ];

        foreach ($featuredAuthors as $featured) {
            FeaturedAuthor::create([
                'id' => $featured[0],
                'author_id' => $featured[1],
                'is_active' => $featured[2],
            ]);
        }
    }
}
