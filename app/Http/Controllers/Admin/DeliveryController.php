<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    //
    public function showDeliveryEdit()
    {
        // 配送データを取得してビューに渡す
        return view('admin.layouts.delivery');
    }

}
