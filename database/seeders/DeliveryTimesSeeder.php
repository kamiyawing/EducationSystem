<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DeliveryTime;
use App\Models\Curriculum;
use Carbon\Carbon;

class DeliveryTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $curriculumIds = Curriculum::pluck('id')->toArray();

        DeliveryTime::factory()->count(50)->create();

        \DB::table('delivery_times')->insert([
            'curriculums_id' => $curriculumIds[array_rand($curriculumIds)],
            'delivery_from' => Carbon::now()->subDays(2),
            'delivery_to' => Carbon::now()->addDays(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);
        //
    }
}
