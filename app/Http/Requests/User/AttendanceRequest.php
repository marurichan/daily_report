<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
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
            'request_content' => 'sometimes|required|max:200',
            'absent_reason'   => 'sometimes|required|max:200',
            'date'            => 'sometimes|required',
        ];
    }

    public function messages()
    {
        return [
            'request_content.required' => '入力必須の項目です',
            'request_content.max'      => '200文字以内で入力してください。',
            'absent_reason.required'   => '入力必須の項目です',
            'absent_reason.max'        => '200文字以内で入力してください。',
            'date.required'            => '入力必須の項目です',
        ];
    }
}

