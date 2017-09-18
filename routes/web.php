<?php

// 登入頁面
Route::group(['prefix' => '/', 'middleware' => 'isLogin'], function () {

    Route::get('/', 'LoginController@index');
});

// 登入或註冊
Route::post('/profile/save', 'SimulationController@saveProfile');

// 載入公開的課表頁面
Route::get('/course/{id}', 'SimulationController@course');

// 載入公開的課表 ajax
Route::get('/load_open_course/{id}', 'SimulationController@loadOpenCourse')->where('id', '[0-9]+');

// 載入已註冊人數
Route::get('/load_joined', 'SimulationController@getJoined');


Route::group(['prefix' => '/', 'middleware' => 'simu'], function () {

    // 登入後首頁
    Route::get('/start', 'SimulationController@index');

    // 搜尋課程
    Route::post('/search_course', 'SimulationController@searchCourse');

    // 儲存課程
    Route::post('/course/save', 'SimulationController@saveCourse');

    // 設定系所
    Route::post('/department/save', 'SimulationController@saveDepartment');

    // 加選課程
    Route::get('/added_course', 'SimulationController@addedCourse');

    // 退選課程
    Route::get('/minus_course/{course_id}', 'SimulationController@minusCourse')->where('course_id', '[0-9A-Za-z]+');

    // 匯入 iTouch 已修過課程頁面
    Route::get('/import', 'SimulationController@import');

    // 匯入 iTouch 已修過課程動作 ajax
    Route::post('/import_course', 'SimulationController@importCourse');

    // 載入已修過課程 ajax
    Route::get('/history', 'SimulationController@history');

    // 我的資料頁面
    Route::get('/my', 'SimulationController@profile');

    // 登出
    Route::get('/logout', 'SimulationController@logout');

    // 儲存課表動作
    Route::post('/course_available/save', 'SimulationController@courseAvailable');

    // 我儲存過的課表頁面
    Route::get('/mycourse', 'SimulationController@myCourse');

    // 載入我的儲存的課表 ajax
    Route::get('/get_my_course', 'SimulationController@getMyCourse');

    // 刪除我的課表
    Route::get('/remove_course/{id}', 'SimulationController@removeCourse');

    // 已修習的學分清單
    Route::get('/pass', 'SimulationController@passCourse');

    // 儲存爬到的已修習之課程
    Route::post('/pass/save', 'SimulationController@savePassCourse');

    // 儲存 MyMentor 下載的課程
    Route::post('/load_mymentor', 'SimulationController@loadMymentor');

    // test
    Route::get('/test', 'SimulationController@test');

    

    // 新增屋子資訊 middleware 判斷是否已認證啟用
    Route::get('/house/post', 'HouseController@post_house')->middleware('isVerify');

    Route::post('/house/post', 'HouseController@post_house_handle')->middleware('isVerify');

    // 找房子頁面
    Route::get('/house', 'HouseController@house');

    Route::post('/house/search', 'HouseController@search_house');

    // 上傳圖片到 imgur
    Route::post('/upload/image', 'SimulationController@upload_image');

    Route::get('/exams', 'ExamController@index');

    Route::get('/exams/post', 'ExamController@past_year');

    Route::get('/exams/news', 'ExamController@exams_news');

    Route::get('/exams/{id}', 'ExamController@exams_info');

    Route::post('/exams/search', 'ExamController@exams_search');

    Route::post('/exams/post/handle', 'ExamController@upload_handle');


                            /* VerifyController */

    // 認證成功顯示資訊
    Route::get('/verify/info', 'VerifyController@verifySuccessInfo');

    // 認證信輸入頁面
    Route::get('/verify', 'VerifyController@verify')->middleware('isVerifyed');

    // 認證信寄件功能
    Route::post('/verify', 'VerifyController@sendMail')->middleware('isVerifyed');

    // 認證信成功寄出頁面
    Route::get('/verify/send', 'VerifyController@sendMailSuccess')->middleware('isVerifyed');

    // 認證啟用功能
    Route::get('/verify/{token}', 'VerifyController@verifyConfirm')->middleware('verifySuccess');


    Route::get('tests', function() {

        Storage::disk('google')->put('test.pdf', 'Hello World');
    });

});

// 房屋資訊
Route::get('/house/{id}', 'HouseController@view_house');
