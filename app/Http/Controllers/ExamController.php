<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Request;

use App\Users;
use App\Exam;

use Storage;
use File;
use Redirect;
use Session;

class ExamController extends Controller
{

    public function index ()
    {
        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
            'og_title'  => "搜尋考古題 | 模擬中原",
            'og_image'  => "https://i.imgur.com/LlYu678.png",
            'og_description' => "小考、期末考總是不知從何念起，這裡為您提供考古題、筆記講義，當然您也能無私提供。",
        );

        return view('exams.index')->with('profile', $data);
    }

    // 新增考古題資訊
    public function past_year ()
    {
        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
        );

        return view('exams.add')->with('profile', $data);
    }


    // 個別考古題資訊
    public function exams_info()
    {
        $examsInfo = Exam::Where('_id', Request::segment(2))->first();

        // 如果不存在此筆資料就導回 /exams
        if ( count($examsInfo) == 0 )
        {
            return redirect('/exams');
        }
        

        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
            'og_title'  => $examsInfo['title'],
            'og_image'  => "https://i.imgur.com/LlYu678.png",
            'og_description' => "小考、期末考總是不知從何念起，這裡為您提供考古題、筆記講義，當然您也能無私提供。",
            'exams'     => $examsInfo
        );

        return view('exams.info')->with('profile', $data);
    }

    // 最新上傳的 5 筆資料
    public function exams_news ()
    {
        echo Exam::take(5)->orderBy('created_at', 'desc')->get();
    }


    // 搜尋考古題
    public function exams_search ()
    {

        $keywords = Request::input('keywords');
        echo Exam::Where('title', 'regex', "/.*$keywords.*/i")->get();
    }


    // 上傳考古題檔案到 Google Drive
    public function upload_handle() {
 
        ini_set('max_execution_time', 300); // 執行時間延長至 300 秒

         // 取得使用者所選擇的檔案
        $files      = Request::file('filefield');

        // 上傳多個檔案時存到陣列
        $filename   = array();
        $fileurl    = array();
        
        foreach ($files as $file) {

            // 副檔名
            $extension = $file->getClientOriginalName();

            Storage::disk('google')->put($extension,  File::get($file), 'public');
        
            // 取得剛剛上傳的檔案名稱 (因為只能抓所有，所以把其他的篩掉)
            $url = collect(Storage::disk('google')->listContents('/', true))->sortBy('timestamp')->last();

            $filename[]   = $extension;
            $fileurl[]    = $url['path'];
        }
        
        $response['status']     = true;
        $response['url']        = $fileurl;
        $response['filename']   = $filename;

        return json_encode($response);
    }



    public function exams_post_handle ()
    {
        // 儲存資訊
        $id = Exam::create([
            'fb_id'         => Session::get('id'),
            'title'         => Request::input('title'),
            'filename'      => Request::input('filename'), 
            'url'           => Request::input('fileurl'),
            'description'   => Request::input('description')
        ])->id;

        echo $id;
    }
    

    // 從 Google Drive 取得檔案
    public function get_files ()
    {
        $files = Storage::disk('google')->listContents('/', true);
        echo json_encode($files);
    }
}
