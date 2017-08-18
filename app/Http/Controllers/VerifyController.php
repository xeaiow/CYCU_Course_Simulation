<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

use Redirect;
use Session;
use Mail;
use App\Http\Requests\emailVerifyRequest;

class VerifyController extends Controller
{

    // 認證信寄件功能
    public function sendMail (emailVerifyRequest $request)
    {
        $data = array( 'email' => $request->email, 'title' => $request->email, 'from' => '學生認證啟用 - 模擬中原' );

        Mail::send( 'emails.welcome', $data, function( $message ) use ($data)
        {
            $message->to( $data['email'] )->from( $data['title'] )->subject( $data['from'] );
        });

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
}
