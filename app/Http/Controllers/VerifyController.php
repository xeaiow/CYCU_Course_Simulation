<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

use Redirect;
use Session;
use Mail;
use App\Email;
use App\Http\Requests\EmailVerifyRequest;

class VerifyController extends Controller
{

    // 認證信寄件功能
    public function sendMail (emailVerifyRequest $request)
    {

        $isExist = Email::Where('email', $request->email)->count();

        // 如果已經註冊過，就擋下
        if ($isExist > 0)
        {
            return redirect('/verify');
        }

        $verifyToken = sha1(time()); // 產生一組 token 作為認證網址後綴

        Users::Where('fb_id', Session::get('id'))->update(['verify.token' => $verifyToken]);

        $data = array( 'email' => $request->email, 'title' => $request->email, 'from' => '學生認證啟用 - 模擬中原', 'token' => $verifyToken );

        Mail::send( 'emails.welcome', $data, function( $message ) use ($data)
        {
            $message->to( $data['email'] )->from( $data['title'] )->subject( $data['from'] );
        });

        // 儲存信箱認證紀錄
        $new = [
            'fb_id' => Session::get('id'),
            'email' => $request->email
        ];

        Email::create($new);

        //將 isVerify 改成 1 Users::Where('fb_id', Session::get('id'))->update(['isVerify' => 1]);

        return redirect('/verify/send');
    }

    // 認證是否為中原學生頁面
    public function verify ()
    {
        $data = array(
            'username'  => Session::get('username'),
            'photo'     => Session::get('photo'),
            'isImport'  => Session::get('isImport')
        );

        return view('auth.verify')->with('profile', $data);
    }


    // 認證信傳送成功頁面
    public function sendMailSuccess ()
    {
        $data = array(
            'username' => Session::get('username'),
            'photo' => Session::get('photo'),
            'isImport' => Session::get('isImport')
        );

        return view('auth.sendSuccess')->with('profile', $data);
    }

    
    // 認證啟用
    public function verifyConfirm (Request $request)
    {
        $isTokenExists = Users::Where('fb_id', Session::get('id'))->Where(['verify.token' => $request->token])->count();
        
        if ($isTokenExists !== 1)
        {
            return "認證碼已過期，請重新填寫認證！";
        }
        
        Users::Where('fb_id', Session::get('id'))->update(['verify.isVerify' => 1]);

        return redirect('/verify/info');
    }


    // 認證啟用成功資訊 
    public function verifySuccessInfo ()
    {
        $data = array(
            'username' => Session::get('username'),
            'photo' => Session::get('photo'),
            'isImport' => Session::get('isImport')
        );

        return view('auth.verifySuccess')->with('profile', $data);
    }
}
