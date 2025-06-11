<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery; // ここでモデルをインポート

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::all(); // 配送データを取得
        return view('user.delivery', compact('deliveries'));
    }
    public function show($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('user.delivery', compact('delivery'));
    }
    public function watch($id)
    {
        $delivery = Delivery::findOrFail($id);
        return view('user.delivery_watch', compact('delivery'));
    }

    public function complete($id)
    {
        $delivery = Delivery::findOrFail($id);
        
        // ここで「受講済み」を記録（例：認証ユーザーのデータに紐付ける）
        auth()->user()->completedDeliveries()->attach($delivery->id);

        return redirect()->route('delivery.show', $delivery->id)->with('success', '受講が完了しました！');
    }

}
