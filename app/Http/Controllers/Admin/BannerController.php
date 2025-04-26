<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function index()
    {
        $files = Storage::files('public/banners');
        return view('admin.banner_edit', ['files' => $files]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'banner' => ['required', 'image', 'max:2048'],
        ], trans('validation.banner'));

        DB::beginTransaction();

        try{
            if ($request->hasFile('banner')){
                $file = $request->file('banner');
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/banners', $filename);

                Banner::create([
                    'image' => $filename,
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', '画像をアップロードしました。');
        }catch (\Exception $e) {
                    DB::rollBack();
                    logger()->error('アップロードエラー:' . $e->getMessage());
                    return redirect()->back()->with('error', 'アップロード中にエラーが発生しました。');   
                }
    }

    public function delete($filename)
    {
        DB::beginTransaction();

        try {
            $filePath = 'public/banners/' . $filename;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            Banner::where('image', $filename)->delete();

            DB::commit();

            return back()->with('success', '画像とデータを削除しました');
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error('削除中にエラー発生:' . $e->getMessage());
        }

            return back()->with('error', '削除中にエラーが発生しました');
        }
        
}

