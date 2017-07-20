<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Users;
use App\addCourse;
use App\historyCourse;

use Auth;
use Redirect;
use Session;

class LoginController extends Controller
{

    public function index()
    {
        $data = array(
            'username' => Session::get('username'),
            'photo' => Session::get('photo'),
            'isImport' => Session::get('isImport')
        );

        return view('login.index')->with('profile', $data);
    }
}
