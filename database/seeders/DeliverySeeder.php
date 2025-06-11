<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Delivery;

class DeliverySeeder extends Seeder
{
    public function run()
    {
        // 例えば、10件のダミーデータを生成する
        Delivery::factory()->count(20)->create();
    }
}
