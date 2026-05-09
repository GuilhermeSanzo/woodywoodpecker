<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookPromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookPromotions = [
            [1, 4, 3],
        ];

        foreach ($bookPromotions as $item) {
            DB::table('book_promotion')->insert([
                'id' => $item[0],
                'book_id' => $item[1],
                'promotion_id' => $item[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
