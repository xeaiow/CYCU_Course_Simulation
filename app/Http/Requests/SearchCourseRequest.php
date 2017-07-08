<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchCourseRequest extends FormRequest
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

    // public function rules()
    // {
    //     return [
    //         'username' => 'required',
    //     ];
    // }

    // public function attributes() {

    //     return [
    //         'username' => '帳號',
    //     ];
    // }

    // // 自訂錯誤訊息
    // public function messages()
    // {
    //     return [
    //         'username.required' => '帳號未填寫',
    //     ];
    // }

    // // 回傳錯誤訊息
    // public function response (array $errors)
    // {
    //     return back()->withErrors($errors)->withInput();
    // }
}
