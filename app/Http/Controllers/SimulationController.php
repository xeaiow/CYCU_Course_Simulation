<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Users;
use App\addCourse;

use Auth;
use Redirect;
use Session;

class SimulationController extends Controller
{
    
    public function index()
    {
        $data = array(
            'username' => Session::get('username'),
            'photo' => Session::get('photo')
        );

        return view('simulation.index')->with('profile', $data);
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

        $joined = Users::where('fb_id', $request->fb_id);

        // 如果沒註冊才新增
        if ($joined->count() > 0) {

           
            $result = $joined->get();

            Session::put('username', $result[0]['name']);
            Session::put('id', $result[0]['fb_id']);
            Session::put('photo', $result[0]['photo']);
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

            Session::put('username', $request->name);
            Session::put('id', $result[0]['fb_id']);
            Session::put('photo', $request->photo);
        }
        return redirect('/');
    }

    // 將加選課程存入資料庫
    public function saveCourse (Request $request)
    {

        $course = [
            'fb_id'     => Session::get('id'),
            'id'        => $request->id,
            'name'      => $request->name,
            'teacher'   => $request->teacher,
            'time_1'    => $request->time_1,
            'time_2'    => $request->time_2,
            'time_3'    => $request->time_3,
            'point'     => $request->point,
            'com_or_opt'=> $request->com_or_opt,
            "phase"     => $request->phase
        ];

        addCourse::create($course);
    }


    // 載入使用者已加選的課程
    public function addedCourse ()
    {

        $result = addCourse::Where('fb_id', Session::get('id'))->get();
        echo $result;
    }


    // 登出
    public function logout ()
    {
        Session::flush();
        return redirect('/');
    }
}
