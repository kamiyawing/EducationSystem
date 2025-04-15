<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255|regex:/\A[ァ-ヴー]+\z/u',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Route::current()->parameter('id')),
            ],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', //mimes:で指定された拡張子か確認
        ];
    }

    public function messages()
    {
        return [
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
    }
}
