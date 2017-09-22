<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HousePostRequest;

use App\Users;
use App\House;

use Redirect;
use Session;

class HouseController extends Controller
{

    // 找房子頁面
    public function house ()
    {
        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
            'og_title'  => "找屋子 | 模擬中原",
            'og_image'  => "https://i.imgur.com/LlYu678.png",
            'og_description' => "中原大學周邊租屋資訊，中原附近房屋心得，讓你得知最真實的資訊。"
        );

        return view('house.index')->with('profile', $data);
    }


    // 新增屋子資訊
    public function post_house (Request $request)
    {
        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
        );

        return view('house.post')->with('profile', $data);
    }


    // 新增屋子資訊 post
    public function post_house_handle (HousePostRequest $request)
    {
        $new = [
            'fb_id' => Session::get('id'),
            'title' => $request->title,
            'marker' => $request->marker,
            'rent_price' => intval($request->rent_price),
            'floor' => intval($request->floor),
            'door' => intval($request->door),
            'space' => intval($request->space),
            'landlord_gender' => intval($request->landlord_gender),
            'house_type' => intval($request->house_type),
            'safe' => filter_var($request->safe, FILTER_VALIDATE_BOOLEAN),
            'extra_pay' => filter_var($request->extra_pay, FILTER_VALIDATE_BOOLEAN),
            'cooking' => filter_var($request->cooking, FILTER_VALIDATE_BOOLEAN),
            'landlord_score' => intval($request->landlord_score),
            'live_score' => intval($request->live_score),
            'landlord_comment' => $request->landlord_comment,
            'live_comment' => $request->live_comment,
            'pictures' => $request->pic
        ];

        $isCreatData = House::create($new);

        if ($isCreatData)
        {
            $response['status'] = true;
            $response['url'] = $isCreatData->id;
            return json_encode($response);
        }
    }


    // 搜尋房屋資訊
    public function search_house (Request $request)
    {
        $keywords = $request->keywords;
        echo House::Where('title', 'regex', "/.*$keywords.*/i")->get();
    }


    // 房屋資訊頁面
    public function view_house (Request $request)
    {

        $houseInfo = House::Where('_id', $request->id)->first();

        // 如果不存在此筆資料就導回 /house
        if ( count($houseInfo) == 0 )
        {
            return redirect('/house');
        }

        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
            'og_title'  => $houseInfo['title'],
            'og_image'  => "https://i.imgur.com/LlYu678.png",
            'og_description' => "中原大學周邊租屋資訊，中原附近房屋心得，讓你得知最真實的資訊。",
            'house'     => $houseInfo
        );

        return view('house.info')->with('profile', $data);
    }
}
