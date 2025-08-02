<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curriculum;

class CurriculumSeeder extends Seeder
{
    public function run()
    {
        Curriculum::create([
            'title' => '国語',
            'thumbnail' => null,
            'description' => '読解力と論理的思考力を育てる授業',
            'video_url' => null,
            'alway_delivery_flg' => 1,
            'grade_id' => 1,
        ]);

        Curriculum::create([
            'title' => '数学',
            'thumbnail' => null,
            'description' => '計算力と応用力を高める授業',
            'video_url' => null,
            'alway_delivery_flg' => 1,
            'grade_id' => 1,
        ]);

        Curriculum::create([
            'title' => '英語',
            'thumbnail' => null,
            'description' => '英語コミュニケーションの基礎を育てる授業',
            'video_url' => null,
            'alway_delivery_flg' => 0,
            'grade_id' => 1,
        ]);
    }
}
