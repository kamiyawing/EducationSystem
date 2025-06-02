<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\DeliveryTime;
use App\Http\Requests\DeliveryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class DeliveryController extends Controller

{
    public function exeDeliveryStore(DeliveryRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $times = $request->input('delivery_times');

            if (!$times || !is_array($times)) {
                return back()->with('error', '配信日時を1件以上入力してください');
            }

            DeliveryTime::saveTimesForCurriculum($id, $times); // ✅ モデルへ集約

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500);
        }

        Session::flash('success_msg', '配信日時を登録しました');
        return redirect(route('admin.show.curriculum.list'));
    }

    public function showDeliveryEdit($id)
    {
        $curriculum = Curriculum::with('delivery_times')->findOrFail($id);

        foreach ($curriculum->delivery_times ?? collect() as $time) {
            $time->from_date = Carbon::parse($time->delivery_from)->format('Y-m-d');
            $time->from_time = Carbon::parse($time->delivery_from)->format('H:i');
            $time->to_date   = Carbon::parse($time->delivery_to)->format('Y-m-d');
            $time->to_time   = Carbon::parse($time->delivery_to)->format('H:i');
        }

        return view('admin.layouts.delivery', compact('curriculum'));
    }

    public function exeDeliveryDestroy($id)
{
    try {
        if (empty($id)) {
            return response()->json(['error' => 'IDがありません'], 400);
        }

        $delivery = DeliveryTime::find($id);
        if (!$delivery) {
            return response()->json(['error' => 'データが存在しません'], 404);
        }

        $delivery->delete();
        return response()->json(['message' => '削除しました']);
    } catch (\Throwable $e) {
        \Log::error($e->getMessage());
        return response()->json(['error' => '削除に失敗しました'], 500);
    }
}
}