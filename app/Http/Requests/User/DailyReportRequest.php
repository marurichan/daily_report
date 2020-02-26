<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'reporting_time' => 'required|before:now',
            'title'          => 'required|max:30',
            'content'       => 'required|max:250',
        ];
    }
  
    public function messages()
    {
        return [
            'reporting_time.before'   => '今日以前の日付を入力してください。',
            'required'                => '入力必須の項目です。',
            'max'                     => '{max}文字以内で入力してください。',
        ];
    }
}
