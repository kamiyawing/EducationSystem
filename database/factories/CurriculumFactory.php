<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\Curriculum;
use App\Models\Grade;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curriculum>
 */
class CurriculumFactory extends Factory
{

    protected $model = Curriculum::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(30),
            'thumbnail' => null,
            'description' => $this->faker->optional()->realText(60),
            'video_url' => $this->faker->optional()->url(),
            'alway_delivery_flg' => $this->faker->randomElement (['0', '1']),
            'grade_id' => Grade::inRandomOrder()->first()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //
        ];
    }
}
