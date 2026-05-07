<?php

namespace Database\Seeders;

use App\Models\BookOfTheMonth;
use Illuminate\Database\Seeder;

class BookOfTheMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $booksOfTheMonth = [
            [1, 1, 1],
            [2, 3, 1],
            [3, 4, 1],
            [5, 3, 1],
        ];

        foreach ($booksOfTheMonth as $item) {
            BookOfTheMonth::create([
                'id' => $item[0],
                'book_id' => $item[1],
                'is_active' => $item[2],
            ]);
        }
    }
}
