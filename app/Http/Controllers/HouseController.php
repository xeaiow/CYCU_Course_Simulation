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
            'isImport'  => Session::get('isImport')
        );

        return view('house.index')->with('profile', $data);
    }


    // 新增屋子資訊
    public function post_house (Request $request)
    {
        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
            'isImport'  => Session::get('isImport')
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
            'safe' => $request->safe,
            'extra_pay' => $request->extra_pay,
            'cooking' => $request->cooking,
            'landlord_score' => intval($request->landlord_score),
            'live_score' => intval($request->live_score),
            'landlord_comment' => $request->landlord_comment,
            'live_comment' => $request->live_comment,
            'pictures' => $request->pic
        ];

        House::create($new);
    }


    // 搜尋房屋資訊
    public function search_house (Request $request)
    {
        $keywords = $request->keywords;
        echo House::Where('title', 'regex', "/.*$keywords.*/i")->get();
    }


    // 房屋資訊頁面
    public function view_house (Request $request) {

        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
            'isImport'  => Session::get('isImport'),
            'house'     => House::Where('fb_id', Session::get('id'))->Where('_id', $request->id)->first()
        );

        return view('house.info')->with('profile', $data);
    }
}
