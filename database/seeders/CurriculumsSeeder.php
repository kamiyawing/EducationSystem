<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Grade;
use App\Models\Curriculum;


class CurriculumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gradeIds = Grade::pluck('id')->toArray();

        Curriculum::factory()->count(72)->create();

        \DB::table('curriculums')->insert([
            [
                'title' => 'ダミー授業1',
                'thumbnail' => 'dummy.jpg',
                'description' => 'ダミー授業1の説明です。',
                'video_url' => 'http://dummy.com/video1',
                'alway_delivery_flg' => 1,
                'grade_id' => $gradeIds[array_rand($gradeIds)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'ダミー授業2',
                'thumbnail' => 'dummy2.jpg',
                'description' => 'ダミー授業2の説明です。',
                'video_url' => 'http://dummy2.com/video1',
                'alway_delivery_flg' => 0,
                'grade_id' => $gradeIds[array_rand($gradeIds)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'ダミー授業3',
                'thumbnail' => 'dummy3.jpg',
                'description' => 'ダミー授業3の説明です。',
                'video_url' => 'http://dummy3.com/video1',
                'alway_delivery_flg' => 1,
                'grade_id' => $gradeIds[array_rand($gradeIds)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'ダミー授業4',
                'thumbnail' => 'dummy4.jpg',
                'description' => 'ダミー授業4の説明です。',
                'video_url' => 'http://dummy4.com/video1',
                'alway_delivery_flg' => 0,
                'grade_id' => $gradeIds[array_rand($gradeIds)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'ダミー授業5',
                'thumbnail' => 'dummy5.jpg',
                'description' => 'ダミー授業5の説明です。',
                'video_url' => 'http://dummy5.com/video1',
                'alway_delivery_flg' => 1,
                'grade_id' => $gradeIds[array_rand($gradeIds)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'ダミー授業6',
                'thumbnail' => 'dummy6.jpg',
                'description' => 'ダミー授業6の説明です。',
                'video_url' => 'http://dummy6.com/video1',
                'alway_delivery_flg' => 0,
                'grade_id' => $gradeIds[array_rand($gradeIds)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
        //
    }
}
