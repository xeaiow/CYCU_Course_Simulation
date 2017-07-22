<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Users;
use App\addCourse;
use App\historyCourse;
use App\courseAvailable;

use Auth;
use Redirect;
use Session;

class SimulationController extends Controller
{
    
    public function index()
    {
        $data = array(
            'username' => Session::get('username'),
            'photo' => Session::get('photo'),
            'isImport' => Session::get('isImport')
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

            $result = $joined->first();

            // 如果沒匯入過就設為 0 否則 1
            ( $result['isImport'] == 0 ? Session::put('isImport', 0) : Session::put('isImport', 1) );     
        }
        else {
            
            // 將使用者資料儲存到 users
            $new = [    
                'fb_id'     => $request->fb_id,
                "birthday"  => $request->birthday,
                'name'      => $request->name,
                'gender'    => $request->gender,
                'photo'     => $request->photo,
                'isImport'  => 0
            ];

            Users::create($new);


            // 建立匯入已修過課程資料
            $history = [
                'fb_id' => $request->fb_id,
                'history_course' => []
            ];
            historyCourse::create($history);


            // 建立模擬選課清單預設資料
            $simulation = [
                'fb_id' => $request->fb_id,
                'add_course' => []
            ];
            addCourse::create($simulation);


            // 是否匯入過課程設為 0
            Session::put('isImport', 0);

        }
    
        Session::put('username', $request->name);
        Session::put('id', $request->fb_id);
        Session::put('photo', $request->photo);

        return redirect('/');
    }

    // 將加選課程存入資料庫
    public function saveCourse (Request $request)
    {

        $addCourse = addCourse::Where('fb_id', Session::get('id'));
        $course = [
            'fb_id'     => Session::get('id'),
            'id'        => $request->id,
            'name'      => $request->name,
            'teacher'   => $request->teacher,
            'class'     => $request->class,
            'time_1'    => $request->time_1,
            'time_2'    => $request->time_2,
            'time_3'    => $request->time_3,
            'point'     => $request->point,
            'com_or_opt'=> $request->com_or_opt,
            "phase"     => $request->phase
        ];

        $addCourse->push(['add_course' => $course]);
    }


    // 載入使用者已加選的課程
    public function addedCourse ()
    {

        echo addCourse::Where('fb_id', Session::get('id'))->get(['add_course'])->first();
    }


    // 匯入已修過的課程
    public function import ()
    {

        $data = array(
            'username' => Session::get('username'),
            'photo' => Session::get('photo'),
            'isImport' => Session::get('isImport')
        );
        return view('simulation.import')->with('profile', $data);
    }


    // 儲存匯入的已修習課程
    public function importCourse (Request $request)
    {

        $historyCourse = historyCourse::Where('fb_id', Session::get('id'));
        $historyCourse->update(['history_course' => $request->history_course]);

        // 設定該使用者為已匯入過
        Users::Where('fb_id', Session::get('id'))->update(['isImport' => 1]);

        // 建立 Session 且設定為已匯入 
        Session::put('isImport', 1);
    }


    // 退選 
    public function minusCourse (Request $request)
    {
        
        // 抓取欲刪除之課程占用的課表位置
        $result = addCourse::Where('fb_id', Session::get('id'))->Where('add_course.id', '=', $request->course_id)->get(['add_course.phase', 'add_course.id'])->first();
       
       // 回傳占用位置
        foreach ($result['add_course'] as $item) {

            if ($item['id'] == $request->course_id) {

               echo json_encode($item['phase']);
            }   
        }
        // 刪除該使用者在 add_course 中指定的課程
        addCourse::Where('fb_id', Session::get('id'))->pull('add_course', array('id'=> $request->course_id));
    }


    // 已修習之課程清單 json
    public function history ()
    {
        
        echo historyCourse::Where('fb_id', Session::get('id'))->first(['history_course']);
    }


    // 我的資料
    public function profile ()
    {

        $find_user = Users::Where('fb_id', Session::get('id'));

        $data = array(
            'username' => Session::get('username'),
            'photo' => Session::get('photo'),
            'isImport' => Session::get('isImport'),
            'userdata' => $find_user->first(),
            'collections' => $find_user->Where('identify', 'exists', true)->first()
        );

        return view('simulation.profile')->with('profile', $data);
    }


    // 儲存的課表
    public function courseAvailable (Request $request)
    {
        $new = [
            'fb_id' => Session::get('id'),
            'course_lists' => $request->added_course,
            'title' => $request->title,
            'rnd_id' => $request->rnd_id
        ];
        courseAvailable::create($new);

        //courseAvailable::Where('fb_id', Session::get('id'))->push(['course_lists' => $request->added_course]);
    }

    // 設定系所
    public function saveDepartment (Request $request)
    {

        echo Users::Where('fb_id', Session::get('id'))->update(['identify.department_id' => $request->department_id, 'identify.department_name' => $request->department_name]);
    } 


    // 我的課表頁面
    public function myCourse ()
    {

        $data = array(
            'username' => Session::get('username'),
            'photo' => Session::get('photo')
        );

        return view('simulation.mycourse')->with('profile', $data);
    }


    // 我的課表 ajax
    public function getMyCourse ()
    {
        echo courseAvailable::Where('fb_id', Session::get('id'))->get(['course_lists.point', 'course_lists.name', 'rnd_id', 'title']);
    }

    // 檢視公開課表
    public function course ()
    {
        return view('simulation.course');
    }


    // 讀取公開課表 ajax (不需登入)
    public function loadOpenCourse (Request $request)
    {
        echo courseAvailable::Where('rnd_id', $request->id)->first();
    }


    // 登出
    public function logout ()
    {
        Session::flush();
        return redirect('/');
    }
}
