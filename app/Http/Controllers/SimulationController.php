<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Users;
use App\addCourse;
use App\historyCourse;
use App\courseAvailable;
use App\House;

use Redirect;
use Session;
use Mail;

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
        $fuzzy = explode(" ", $request->keywords); // ex. ['教育實習', '5-2345.']
        $year_class = $request->year_class; // 篩選開課系所

        if ($year_class !== null)
        {

            // 如果使用者輸入的是一般搜尋，就用 %LIKE% 找課程
            if (count($fuzzy) == 1)
            {

                $keywords = $request->keywords;

                echo Course::
                where('course_name', 'regex', "/.*$keywords.*/i")
                    ->orWhere('course_id', $keywords)
                    ->orWhere('teacher', 'regex', "/.*$keywords.*/i")
                    ->orWhere('time_1', 'regex', "/.*$keywords.*/i")
                    ->Where('class', $year_class)
                ->get();
            }
            // 如果使用者用模糊搜尋，就將課程及時間解析再搜尋
            else
            {

                $time = $fuzzy[1]."."; // 資料當初結構問題，所以結尾要加一個 .

                echo Course::Where('course_name', 'regex', "/.*$fuzzy[0].*/i")
                ->Where('time_1', $time)
                ->Where('class', $year_class)
                ->get();
            }
        }
        else
        {
            // 如果使用者輸入的是一般搜尋，就用 %LIKE% 找課程
            if (count($fuzzy) == 1)
            {

                $keywords = $request->keywords;

                echo Course::
                where('course_name', 'regex', "/.*$keywords.*/i")
                    ->orWhere('course_id', $keywords)
                    ->orWhere('teacher', 'regex', "/.*$keywords.*/i")
                    ->orWhere('time_1', 'regex', "/.*$keywords.*/i")
                ->get();
            }
            // 如果使用者用模糊搜尋，就將課程及時間解析再搜尋
            else
            {

                $time = $fuzzy[1]."."; // 資料當初結構問題，所以結尾要加一個 .

                echo Course::Where('course_name', 'regex', "/.*$fuzzy[0].*/i")->
                Where('time_1', $time)->get();
            }   
        }
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
                'email'     => $request->email,
                'isImport'  => 0
            ];

            Users::create($new);


            // 建立匯入已修過課程資料
            // $history = [
            //     'fb_id' => $request->fb_id,
            //     'history_course' => []
            // ];
            // historyCourse::create($history);


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

        if (Session::get('isImport') === 1) {

            return redirect('/');
        }

        $data = array(
            'username' => Session::get('username'),
            'photo' => Session::get('photo'),
            'isImport' => Session::get('isImport')
        );

        return view('simulation.import')->with('profile', $data);
    }


    // 儲存匯入的已修習課程
    // public function importCourse (Request $request)
    // {

    //     $historyCourse = historyCourse::Where('fb_id', Session::get('id'));
    //     $historyCourse->update(['history_course' => $request->history_course]);

    //     $history = [
    //             'fb_id' => Session::get('id'),
    //             'history_course' => $request->history_course
    //         ];
    //     historyCourse::create($history);

    //     // 設定該使用者為已匯入過
    //     Users::Where('fb_id', Session::get('id'))->update(['isImport' => 1]);

    //     // 建立 Session 且設定為已匯入 
    //     Session::put('isImport', 1);
    // }


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


    // 儲存的課表 (2017.9/18 取消 rnd_id 欄位，改用 _id)
    public function courseAvailable (Request $request)
    {
        $new = [
            'fb_id'         => Session::get('id'),
            'course_lists'  => $request->added_course,
            'title'         => $request->title
        ];
        courseAvailable::create($new);
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
        echo courseAvailable::Where('fb_id', Session::get('id'))->orderBy('_id', 'desc')->get(['course_lists.point', 'course_lists.name', 'title']);
    }

    // 檢視公開課表
    public function course (Request $request)
    {
        $exists = courseAvailable::Where('_id', $request->id)->orWhere('rnd_id', $request->id);
        
        if ($exists->count() == 0) {

            return redirect('/');
        }
        return view('simulation.course')->with('data', $exists->first());
    }


    // 讀取公開課表 ajax (不需登入)
    public function loadOpenCourse (Request $request)
    {
        echo $exists = courseAvailable::Where('_id', $request->id)->orWhere('rnd_id', $request->id)->first(['course_lists', 'created_at', 'title']);
    }


    // 載入已註冊人數
    public function getJoined ()
    {
        echo Users::count();
    }


    // 刪除我的課表
    public function removeCourse (Request $request)
    {

        $remove_course = courseAvailable::Where('fb_id', Session::get('id'))->Where('_id', $request->id)->first();
        
        // 如果該編號是我的課表才刪除
        if ($remove_course !== null) {

            echo $remove_course->delete();
        }

        return redirect('/start');
    }


    public function loadMymentor (Request $request)
    {

        $url        = "http://cmap.cycu.edu.tw:8080//MyMentor/stdLogin.do" ;
        $ref_url    = "http://cmap.cycu.edu.tw:8080/MyMentor/courseCreditStructure.do";
        $userId     = $request->userId;
        $password   = $request->password;
        

        $cookie_jar = tempnam('./tmp','cookie.txt');
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $ref_url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "userId=". $userId ."&password=". $password);
        curl_exec ($ch);
    
        curl_close ($ch);

        $ch2 = curl_init();

        curl_setopt($ch2, CURLOPT_URL, "http://cmap.cycu.edu.tw:8080/MyMentor/courseCreditStructure.do");
        curl_setopt($ch2, CURLOPT_HEADER, 0);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)" );
        curl_setopt($ch2, CURLOPT_CONNECTTIMEOUT, 0);

        curl_setopt($ch2, CURLOPT_COOKIEFILE, $cookie_jar);
        
        $orders = curl_exec($ch2);
        curl_close($ch2);
        

        $preg = "/<tr>(.*?)<\/tr>/si"; 
        preg_match_all($preg, $orders, $arr);

        echo json_encode($arr[0]);
    }


    // 儲存已爬到的已修習之課程
    public function savePassCourse (Request $request)
    {

        // $historyCourse = historyCourse::Where('fb_id', Session::get('id'));
        // $historyCourse->update(['history_course' => $request->history_course]);
        $new = [    
            'fb_id' => Session::get('id'),
            'history_course' => $request->history_course
        ];

        historyCourse::create($new);

        //設定該使用者為已匯入過
        Users::Where('fb_id', Session::get('id'))->update(['isImport' => 1]);

        //建立 Session 且設定為已匯入 
        Session::put('isImport', 1);

        
    }


    // 列出已修習的清單
    public function passCourse ()
    {

        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
            'isImport'  => Session::get('isImport')
        );

        return view('simulation.pass')->with('profile', $data);
    }

    // imgur 可多張圖片上傳
    public function upload_image ()
    {

        $result = array();

        foreach ($_FILES['userImage']['tmp_name'] as $index => $tmpName)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID '.'5f2eaa3314e3d73'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => file_get_contents($tmpName)));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $reply  = curl_exec($ch);
            curl_close($ch);
            $result[] = json_decode($reply)->data->link;
        }

        return json_encode($result);
    }


    // 登出
    public function logout ()
    {
        Session::flush();
        return redirect('/');
    }

}
