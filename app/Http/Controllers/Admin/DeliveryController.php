<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Models\DeliveryTime;
use App\Http\Requests\DeliveryRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DeliveryController extends Controller

{
    public function exeDeliveryStore(DeliveryRequest $request , $id)
    {

        \DB::beginTransaction();
        try {
            $curriculum_id = $id;
            $times = $request->input('delivery_times');

            if (!$times || !is_array($times)) {
                return back()->with('error', '配信日時を1件以上入力してください');
            }

            $submittedIds = [];

            foreach ($times as $time) {
                $data = [
                    'curriculums_id' => $curriculum_id,
                    'delivery_from' => Carbon::parse($time['from_date'] . ' ' . $time['from_time']),
                    'delivery_to' => Carbon::parse($time['to_date'] . ' ' . $time['to_time']),
                ];
    
                if (!empty($time['id'])) {
                    $existing = DeliveryTime::find($time['id']);
                    if ($existing) {
                        $existing->update($data);
                        $submittedIds[] = $existing->id;
                    }
                } else {
                    $new = DeliveryTime::create($data);
                    $submittedIds[] = $new->id;
                }
            }
    
            // 登録されなかったIDを削除（画面から削除された行）
            DeliveryTime::where('curriculums_id', $curriculum_id)
                ->whereNotIn('id', $submittedIds)
                ->delete();

            \DB::commit();

        } catch(\Throwable $e) {
            \DB::rollback();
            // dd($e->getMessage());
            \Log::error($e->getMessage());
            abort(500);
        }

        \Session::flash('err_msg','配信日時を登録しました');
        return redirect(route('admin.show.curriculum.list'));

    }
    //
    public function showDeliveryEdit($id)
    {

        $curriculum = Curriculum::with('delivery_times')->findOrFail($id);
    

        // delivery_timesごとに日付・時間を分解して追加
        foreach ($curriculum->delivery_times ?? collect() as $time) {
            $time->from_date = \Carbon\Carbon::parse($time->delivery_from)->format('Y-m-d');
            $time->from_time = \Carbon\Carbon::parse($time->delivery_from)->format('H:i');

            $time->to_date   = \Carbon\Carbon::parse($time->delivery_to)->format('Y-m-d');
            $time->to_time   = \Carbon\Carbon::parse($time->delivery_to)->format('H:i');
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