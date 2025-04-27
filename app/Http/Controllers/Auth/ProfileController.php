<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserPassUpdateRequest;

class ProfileController extends Controller
{
    public function usersTop() {
        $userModel = new User();
        $userData = $userModel->userGetList();
        $articleModel = new Article();
        $articles = $articleModel->articleGetList();
        return view('auth/usersTop', compact('userData','articles'));
    }

    public function usersEdit() {
        $userModel = new User();
        $userData = $userModel->userGetList();
        return view('auth/profile_edit', compact('userData'));
    }

    public function usersUpdate(ProfileRequest $Request, $id) {
        $userModel = new User();
        $userData = $userModel->userGetList();
            // 画像がアップロードされ、既存データが存在する場合
        if ($Request->hasFile('profile_image') && $userData->profile_image) {
            // 既存の画像ファイルを削除
          Storage::delete('public/image/'. basename($userData->profile_image));
          $image_path = $this->uploadProfileImage($Request);
            // 画像ファイルがアップロードされ、データが未登録の場合
        } elseif ($Request->hasFile('profile_image') && !$userData->profile_image) {
          $image_path = $this->uploadProfileImage($Request);
            // 画像ファイルがアップロードされず、データが存在した場合
        } elseif (!$Request->hasFile('img_path') && $userData->profile_image) {
            // 既存の画像ファイルを削除
          Storage::delete('public/image/'. basename($userData->profile_image));
          $image_path = null;
            // 画像ファイルがアップロードされず、データも存在しない場合　※何もしない 
        } else {
          $image_path = null;
        }
            //トランザクション
        DB::beginTransaction();
        try {
          $userModel->updateProfile($id , $Request , $image_path);
          DB::commit();
        } catch (\Exception $e) {
          DB::rollBack();
        }
        //任意のViewにリダイレクト
      return redirect()->route('usersEdit');
    }

    public function usersPassEdit() {
        $userModel = new User();
        $userData = $userModel->userGetList();
        return view('auth/password_edit', compact('userData'));
    }

    public function usersPassUpdate(UserPassUpdateRequest $Request, $id) {
        $userModel = new User();
            //トランザクション
            DB::beginTransaction();
            try {
              $userModel->userPassUpdate($id , $Request);
              DB::commit();
              return redirect()->route('usersEdit')->with('success', __('パスワードを変更しました。'));
            } catch (\Exception $e) {
              DB::rollBack();
              return redirect()->back()->withErrors(['error' => __('パスワードの変更に失敗しました。')]);
            }
    }

    protected function uploadProfileImage($Request) {
            //画像ファイルの取得
          $image = $Request->file('profile_image');
            //画像ファイルのファイル名を取得
          $file_name = $image->getClientOriginalName();
            // ファイル名に日付を追加
          $file_name = date('YmdHis') . '_' . $file_name;
            //storage/app/public/imageフォルダ内に、取得したファイル名で保存
          $image ->storeAs('public/image/', $file_name);
            //データベース登録用に、ファイルパスを作成
          return 'storage/image/' . $file_name;
    }
}