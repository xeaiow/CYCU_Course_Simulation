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

    public function past_year ()
    {
        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
            'isImport'  => Session::get('isImport')
        );

        return view('exams.index')->with('profile', $data);
    }

    public function upload_handle() {
 
        $file = Request::file('filefield'); // 檔名
        $extension = $file->getClientOriginalExtension(); // 副檔名
        
        Storage::disk('google')->put($file->getFilename().'.'.$extension,  File::get($file), 'public');
       

        // 取得剛剛上傳的檔案名稱 (因為只能抓所有，所以把其他的篩掉)
        $url = collect(Storage::disk('google')->listContents('/', true))->sortBy('timestamp')->last();

        // 儲存資訊
        Exam::create(['fb_id' => Session::get('id'), 'filename' => $file->getFilename().'.'.$extension, 'url' => $url['path']]);
 
        echo "yes";
		// return redirect('/exams');
	}


    public function get_files ()
    {
        $files = Storage::disk('google')->listContents('/', true);
        echo json_encode($files);
    }
}
