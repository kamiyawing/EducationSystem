<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use App\Models\CurriculumProgress;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    // 配信一覧表示（教材＋配信時刻）
    public function index()
    {
        $deliveries = DeliveryTime::with('curriculum')->get();
        return view('user.delivery', compact('deliveries'));
    }

    // 配信詳細表示（教材内容の確認）
    public function show($id)
    {
        $delivery = DeliveryTime::with('curriculum')->findOrFail($id);
        return view('user.delivery', compact('delivery'));
    }

    // 視聴画面表示（教材の動画や資料）
    public function watch($id)
    {
        $delivery = DeliveryTime::with('curriculum')->findOrFail($id);
        return view('user.delivery_watch', compact('delivery'));
    }

    // 視聴完了処理（学習完了を記録）
    

    public function complete($id)
    {
        // ログインユーザー取得
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインが必要です。');
        }

        // 配信データ取得（カリキュラム付き）
        $delivery = DeliveryTime::with('curriculum')->find($id);

        if (!$delivery || !$delivery->curriculum_id) {
            return redirect()->route('delivery.index')->with('error', '指定された配信データが見つかりませんでした。');
        }

        // 受講記録の取得 or 新規作成
        $progress = CurriculumProgress::firstOrNew([
            'user_id' => $user->id,
            'curriculum_id' => $delivery->curriculum_id,
        ]);

        // 視聴完了フラグを更新（既存でも新規でも）
        $progress->clear_flg = 1;
        $progress->save();

        return redirect()->route('delivery.show', $delivery->id)
                        ->with('success', '受講が完了しました！');
    }



}
