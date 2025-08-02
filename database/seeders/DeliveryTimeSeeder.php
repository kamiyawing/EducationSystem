<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeliveryTime;
use Carbon\Carbon;

class DeliveryTimeSeeder extends Seeder
{
    public function run()
    {
        // 教材1の配信時間
        DeliveryTime::create([
            'curriculum_id' => 1,
            'start_time' => Carbon::create(2025, 8, 1, 9, 0, 0),
            'end_time'   => Carbon::create(2025, 8, 1, 17, 0, 0),
        ]);

        // 教材2の配信時間
        DeliveryTime::create([
            'curriculum_id' => 2,
            'start_time' => Carbon::create(2025, 8, 2, 10, 0, 0),
            'end_time'   => Carbon::create(2025, 8, 2, 16, 0, 0),
        ]);

        // 教材3の配信時間
        DeliveryTime::create([
            'curriculum_id' => 3,
            'start_time' => Carbon::create(2025, 8, 3, 13, 0, 0),
            'end_time'   => Carbon::create(2025, 8, 3, 18, 0, 0),
        ]);
    }
}
