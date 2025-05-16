<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'delivery_times' => ['nullable', 'array'],
            'delivery_times.*.from_date' => ['required_with:delivery_times'],
            'delivery_times.*.from_time' => ['required_with:delivery_times'],
            'delivery_times.*.to_date'   => ['required_with:delivery_times'],
            'delivery_times.*.to_time'   => ['required_with:delivery_times'],
        ];

        // 常時公開OFF時は、配信日時必須
        if ((int) $this->input('alway_delivery_flg') === 0) {
            $rules['delivery_times'] = ['required', 'array', 'min:1'];
        }

        return $rules;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
        $times = $this->input('delivery_times');

        if (is_array($times)) {
            foreach ($times as $i => $time) {
                $from = strtotime($time['from_date'] . ' ' . $time['from_time']);
                $to   = strtotime($time['to_date'] . ' ' . $time['to_time']);

                if ($from >= $to) {
                    $validator->errors()->add("delivery_times.$i.to_date", "配信終了日時は開始日時より後にしてください");
                }
            }
        }
    });
}

}