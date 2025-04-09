<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\Curriculum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DeliveryTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'curriculums_id' => Curriculum::inRandomOrder()->first()->id,
            'delivery_from' => Carbon::now()->subDays(2),
            'delivery_to' => Carbon::now()->addDays(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            //
        ];
    }
}
