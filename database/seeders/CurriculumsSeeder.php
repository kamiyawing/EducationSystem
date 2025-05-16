<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Grade;
use App\Models\Curriculum;
use App\Models\DeliveryTime;


class CurriculumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    Curriculum::factory()
    ->count(70)
    ->create()
    ->each(function ($curriculum) {
        if ($curriculum->alway_delivery_flg === 0) {
            DeliveryTime::factory()->count(2)->create([
                'curriculums_id' => $curriculum->id,
                'delivery_from' => Carbon::now()->addDays(1),
                'delivery_to' => Carbon::now()->addDays(10),
            ]);
        }
        // alway_delivery_flg = 1 のときは何もしない（＝生成しない）
    });

    }
}