<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum; // ここでモデルをインポート

class DeliveryController extends Controller
{
    public function index()
    {
        $curriculums = Curriculum::all(); // 配送データを取得
        return view('user.delivery', compact('curriculums'));
    }
    public function show($id)
    {
        $curriculums = Curriculum::findOrFail($id);
        return view('user.delivery', compact('delivery'));
    }
    public function watch($id)
    {
        $curriculums = Curriculum::findOrFail($id);
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
