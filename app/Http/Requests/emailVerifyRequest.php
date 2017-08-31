<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class emailVerifyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'regex:/(.*)@cycu\.+(edu|org)+.tw/i'
            ],
        ];
    }

    public function attributes() {

        return [
            'email' => '校園信箱',
        ];
    }

    // 自訂錯誤訊息
    public function messages()
    {
        return [
            'email.required' => '校園信箱未填寫',
            'email.email' => '請填寫正確信的箱格式',
            'email.regex' => '校園信箱格式錯誤，請參考右側提示！'
        ];
    }

    // 回傳錯誤訊息
    public function response (array $errors)
    {
        return back()->withErrors($errors)->withInput();
    }
}
