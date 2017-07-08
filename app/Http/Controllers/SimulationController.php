<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Users;

class SimulationController extends Controller
{
    
    public function index()
    {
        return view('simulation.index');
    }

    // 關鍵字搜尋課程
    public function searchCourse (Request $request)
    {
        $keywords = $request->keywords;

        $result = Course::
        where('course_name', 'regex', "/.*$keywords.*/i")
        ->orWhere('course_id', $keywords)
        ->orWhere('teacher', $keywords)
        ->get();

        echo $result;
    }

    // 儲存 fb 登入資訊
    public function saveProfile (Request $request)
    {

        $joined = Users::where('fb_id', $request->fb_id)->count();

        // 如果沒註冊才新增
        if ($joined > 0) {

            echo "已註冊";
        }
        else {
            
            $new = [    
                'fb_id'     => $request->fb_id,
                "birthday"  => $request->birthday,
                'name'      => $request->name,
                'gender'    => $request->gender,
                'photo'     => $request->photo,
            ];

            Users::create($new);
        }
    }
}
