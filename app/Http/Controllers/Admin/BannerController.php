<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Banner;

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
            'banner' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('banner')) {
            $filename = $request->file('banner')->hashName();
            $request->file('banner')->store('public/banners');
    
            //DB保存
            Banner::create([
                'image' => $filename,
            ]);

        $path = $request->file('banner')->store('public/banners');
        return redirect()->route('admin.banner')->with('success', '画像をアップロードしました！');
    }
    }

    public function delete($filename)
    {
        Storage::delete('public/banners/' . $filename);
        return redirect()->route('admin.banner')->with('success', '画像を削除しました！');
    }

}