<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HousePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'             => 'required',
            'marker'            => 'required',
            'rent_price'        => 'required',
            'floor'             => 'required',
            'door'              => 'required',
            'space'             => 'required',
            'landlord_gender'   => 'required',
            'house_type'        => 'required',
            'landlord_score'    => 'required',
            'live_score'        => 'required'
        ];
    }

    public function attributes() {

        return [
            'title'             => '標題',
            'marker'            => '地址 / 地標',
            'rent_price'        => '價格',
            'floor'             => '樓高',
            'door'              => '戶數',
            'space'             => '坪數',
            'landlord_gender'   => '房東性別',
            'house_type'        => '房屋類型',
            'landlord_score'    => '房東滿意度',
            'live_score'        => '居住滿意度'
        ];
    }

    // 自訂錯誤訊息
    public function messages()
    {
        return [
            'title.required'             => '請填寫標題',
            'marker.required'            => '請填寫地址 / 地標',
            'rent_price.required'        => '請填寫價格',
            'floor.required'             => '請填寫樓高',
            'floor.numeric'              => '樓高請填寫數字',
            'door.required'              => '請填寫戶數',
            'door.numeric'               => '戶數請填寫數字',
            'space.required'             => '請填寫大約坪數',
            'space.numeric'              => '坪數請填寫數字',
            'landlord_gender.required'   => '請填寫房東性別',
            'house_type.required'        => '請填寫房屋類型',
            'landlord_score.required'    => '請填寫房東滿意度',
            'landlord_score.numeric'     => '房東滿意度只能填寫數字 0~9',
            'landlord_score.max'         => '房東滿意度只能填寫數字 0~9',
            'live_score.required'        => '請填寫居住滿意度',
            'live_score.numeric'         => '居住滿意度只能填寫數字 0~9',
            'live_score.max'             => '居住滿意度只能填寫數字 0~9'
        ];
    }

    // 回傳錯誤訊息
    public function response (array $errors)
    {
        return back()->withErrors($errors)->withInput();
    }
}
