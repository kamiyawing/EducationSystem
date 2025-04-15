<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserPassUpdateRequest extends FormRequest
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
            'old_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail(__('現在登録されているパスワードと一致しません。'));
                }
              }],
            'new_password' =>['required','confirmed','string','regex:/^(?=.*?[a-zA-Z])(?=.*?\d)[a-zA-Z\d]{8,}$/','min:8','max:255'],
            'new_password_confirmation' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => '旧パスワードは必須項目です。',
            'new_password.required' => '新パスワードは必須項目です。',
            'new_password.string' => '新パスワードは文字列で入力してください。',
            'new_password.regex' => '新パスワードは半角英数混合8文字以上255文字以内で入力してください。',
            'new_password.min' => '新パスワードは半角英数混合8文字以上255文字以内で入力してください。',
            'new_password.max' => '新パスワードは半角英数混合8文字以上255文字以内で入力してください。',
            'new_password.confirmed' => '新パスワードと確認欄が一致しません。',
            'new_password_confirmation.required' => '新パスワード確認は必須項目です。',
        ];
    }
}
