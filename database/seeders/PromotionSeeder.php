<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions = [
            [
                'id' => 1,
                'name' => 'Dia das mães',
                'is_active' => 1,
                'start_date' => '2016-05-01',
                'end_date' => '2016-05-31',
            ],
            [
                'id' => 2,
                'name' => 'Natal',
                'is_active' => 0,
                'start_date' => '2016-12-01',
                'end_date' => '2016-12-31',
            ],
            [
                'id' => 3,
                'name' => 'Mês dos pais',
                'is_active' => 1,
                'start_date' => '2016-08-01',
                'end_date' => '2016-08-31',
            ],
        ];

        foreach ($promotions as $promotion) {
            Promotion::create($promotion);
        }
    }
}
