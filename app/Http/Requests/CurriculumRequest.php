<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurriculumRequest extends FormRequest
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

        $rules = [

            'title' => ['required'],
            'grade_id' => ['required'],
            'video_url' => ['required'],
            'description' => ['required'],

        ];

        if (!$this->has('alway_delivery_flg')) {
            $rules['delivery_times'] = ['required', 'array'];
            $rules['delivery_times.*.from_date'] = ['required', 'date'];
            $rules['delivery_times.*.from_time'] = ['required'];
            $rules['delivery_times.*.to_date'] = ['required', 'date'];
            $rules['delivery_times.*.to_time'] = ['required'];
        }

    return $rules;

    }

 }
