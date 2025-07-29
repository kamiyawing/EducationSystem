<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BannerRequest;

class BannerController extends Controller
{
    /**
     * バナー一覧画面（アップロード済みの画像ファイル一覧を表示）
     */
    public function index()
    {
        // "public/images/banner" 内のファイルリストを取得し、URLに変換する
        $files = collect(Storage::files('public/images/banner'))->map(function ($file) {
            return Storage::url($file);
        });

        return view('admin.banner_edit', ['files' => $files]);
    }

    /**
     * 画像アップロード処理
     * - アップロードされた画像を、元のファイル名で "public/images/banner" に保存
     * - DBには "storage/images/banner/ファイル名" の形で登録する
     */
    public function upload(BannerRequest $request)
    {
        DB::beginTransaction();

        try {
            if ($request->hasFile('banner')) {
                $file = $request->file('banner');
                // アップロードされた画像名そのままで保存
                $filename = $file->getClientOriginalName();
                // 保存先を "public/images/banner" に変更
                $file->storeAs('public/images/banner', $filename);
                // DBへは "storage/images/banner/ファイル名" として登録
                $path = 'storage/images/banner/' . $filename;
            
                Banner::create([
                    'image' => $path,
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', '画像をアップロードしました。');
        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('アップロードエラー:' . $e->getMessage());
            return redirect()->back()->with('error', 'アップロード中にエラーが発生しました。');
        }
    }

    /**
     * 画像削除処理
     * - DBに登録された画像データは "storage/images/banner/ファイル名" の形になっているため、
     *   実際のファイルは "public/images/banner/ファイル名" から削除する
     */
    public function delete($filename)
    {
        DB::beginTransaction();

        try {
            // 保存先ディレクトリを "public/images/banner" に変更する
            $filePath = 'public/images/banner/' . $filename;
            logger()->info("削除対象のファイル: " . $filePath);
            
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            // DB上のデータは "storage/images/banner/ファイル名" で登録されているため
            Banner::where('image', 'storage/images/banner/' . $filename)->delete();

            DB::commit();

            return back()->with('success', '画像とデータを削除しました');
        } catch (\Exception $e) {
            DB::rollback();
            logger()->error('削除中にエラー発生:' . $e->getMessage());
            return back()->with('error', '削除中にエラーが発生しました');
        }
    }

    /**
     * バナー切り替え（非同期）処理
     * - リクエストで現在表示中のバナーID（current_banner_id）を受け取り、
     *   次のバナー（ID昇順で）を取得して返します
     * - 次のバナーが存在しない場合は、先頭バナーに戻ります
     * - DBには "storage/images/banner/ファイル名" が登録されており、asset()を用いてURL生成します
     */
    public function switchBanner(Request $request)
    {
        // 現在表示中のバナーIDをリクエストから取得
        $currentBannerId = $request->query('current_banner_id');

        if ($currentBannerId) {
            // 現在のIDより大きいレコードから最初のバナー（次のバナー）を取得
            $nextBanner = Banner::where('id', '>', $currentBannerId)
                                ->orderBy('id', 'asc')
                                ->first();
        }

        // 次のバナーが見つからない場合、またはパラメータが渡されなかった場合は、先頭バナーを返す
        if (empty($nextBanner)) {
            $nextBanner = Banner::orderBy('id', 'asc')->first();
        }

        if (!$nextBanner) {
            return response()->json(['error' => 'バナーが見つかりません'], 404);
        }

        // DBに登録されたパスは "storage/images/banner/ファイル名" となっているため、
        // asset() で正しいURLを生成できる
        $imageUrl = asset('storage/images/banner/'.$nextBanner->image);

        return response()->json([
            'success'   => true,
            'banner_id' => $nextBanner->id,
            'image_url' => $imageUrl,
        ]);
    }
}
