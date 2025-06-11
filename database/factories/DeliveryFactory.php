<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    protected $model = \App\Models\Delivery::class;

    public function definition()
    {
        return [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'thumbnail'   => $this->faker->imageUrl(640, 480, 'transport', true), // お好みで編集
            'start_time'  => $this->faker->dateTimeBetween('-1 hours', '+2 hours'),
            'end_time'    => $this->faker->dateTimeBetween('+2 hours', '+2 months'),
            'video_path'  => $this->faker->imageUrl(640, 480, 'abstract', true) // ここは実際の動画パスに合わせて変更
        ];
    }
}
