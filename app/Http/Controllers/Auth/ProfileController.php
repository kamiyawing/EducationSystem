<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function usersTop() {
        $userModel = new User();
        $userData = $userModel->userGetList();
        return view('auth/usersTop', compact('userData'));
    }

    public function usersEdit() {
        $userModel = new User();
        $userData = $userModel->userGetList();
        return view('auth/profile_edit', compact('userData'));
    }

    public function usersUpdate(Request $Request, $id) {
        $userModel = new User();
        $userData = $userModel->userGetList();
        $messages = [
          'name.required' => 'ユーザーネームは必須項目です。',
          'name.string' => 'ユーザーネームは文字列で入力してください。',
          'name.max' => 'ユーザーネームは255文字以内で入力してください。',
          'name_kana.required' => 'カナは必須項目です。',
          'name_kana.string' => 'カナは文字列で入力してください。',
          'name_kana.max' => 'カナは255文字以内で入力してください。',
          'name_kana.regex' => 'カナは全角カタカナで入力してください。',
          'email.required' => 'メールアドレスは必須項目です。',
          'email.email' => '有効なメールアドレス形式で入力してください。',
          'email.max' => 'メールアドレスは255文字以内で入力してください。',
          'email.unique' => 'このメールアドレスは既に登録されています。',
          'profile_image.image' => 'プロフィール画像は画像ファイルを選択してください。',
          'profile_image.mimes' => 'プロフィール画像はjpeg、png、jpg形式でアップロードしてください。',
          'profile_image.max' => 'プロフィール画像のファイルサイズは2MBまでです。',
        ];
        $Request->validate([
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255|regex:/\A[ァ-ヴー]+\z/u',
            'email' => [
              'required',
              'email',
              'max:255',
              Rule::unique('users')->ignore($userData->id),
            ],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', //mimes:で指定された拡張子か確認
            ], $messages);
        if ($Request->hasFile('profile_image') && $userData->profile_image) {
            // 既存の画像ファイルを削除
          Storage::delete('public/image/'. basename($userData->profile_image));
            //画像ファイルの取得
          $image = $Request->file('profile_image');
            //画像ファイルのファイル名を取得
          $file_name = $image->getClientOriginalName();
            // ファイル名に日付を追加
          $file_name = date('YmdHis') . '_' . $file_name;
            //storage/app/public/imageフォルダ内に、取得したファイル名で保存
          $image ->storeAs('public/image/', $file_name);
            //データベース登録用に、ファイルパスを作成
          $image_path = 'storage/image/' . $file_name;
          // 画像ファイルがアップロードされ、データが未登録の場合
        } elseif ($Request->hasFile('profile_image') && !$userData->profile_image) {
            //画像ファイルの取得
          $image = $Request->file('profile_image');
            //画像ファイルのファイル名を取得
          $file_name = $image->getClientOriginalName();
            // ファイル名に日付を追加
          $file_name = date('YmdHis') . '_' . $file_name;
            //storage/app/public/imageフォルダ内に、取得したファイル名で保存
          $image ->storeAs('public/image/', $file_name);
            //データベース登録用に、ファイルパスを作成
          $image_path = 'storage/image/' . $file_name;
          // 画像ファイルがアップロードされず、データが存在した場合場合
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
            try{
            $userModel->updateProfile($id , $Request , $image_path);
            DB::commit();
            }catch(\Exception $e){
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

    public function usersPassUpdate(Request $Request, $id) {
        $userModel = new User();
        $userData = $userModel->userGetList();
        $messages = [
          'old_password.required' => '旧パスワードは必須項目です。',
          'new_password.required' => '新パスワードは必須項目です。',
          'new_password.string' => '新パスワードは文字列で入力してください。',
          'new_password.regex' => '新パスワードは半角英数混合8文字以上255文字以内で入力してください。',
          'new_password.min' => '新パスワードは半角英数混合8文字以上255文字以内で入力してください。',
          'new_password.max' => '新パスワードは半角英数混合8文字以上255文字以内で入力してください。',
          'new_password.confirmed' => '新パスワードと確認欄が一致しません。',
          'new_password_confirmation.required' => '新パスワード確認は必須項目です。',
        ];
        $Request->validate([
            'old_password' => ['required', function ($attribute, $value, $fail) use ($userData) {
                if (!Hash::check($value, $userData->password)) {
                    $fail(__('現在登録されているパスワードと一致しません。'));
                }
              }],
            'new_password' =>['required','confirmed','string','regex:/^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,}$/','min:8','max:255'],
            'new_password_confirmation' => 'required',
        ], $messages);
            //トランザクション
            DB::beginTransaction();
            try{
            $userModel->userPassUpdate($id , $Request);
            DB::commit();
            return redirect()->route('usersEdit')->with('success', __('パスワードを変更しました。'));
            }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => __('パスワードの変更に失敗しました。')]);
        }
    }
}