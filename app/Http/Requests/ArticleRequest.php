<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required | string | max:255',
            'posted_date' => 'required | date',
            'article_contents' => 'required | string',
        ];
    }

    public function messages()
    {
        return [
          'title.required' => 'お知らせタイトルは入力必須項目です。',
          'title.max' => 'お知らせタイトルは255文字以内で入力してください。',
          'posted_date.required' => '投稿日時は入力必須項目です',
          'posted_date.date' => '投稿日時は日付の形式で入力してください。',
          'article_contents.required' => 'お知らせ本文は必須項目です。',
        ];
    }
}
