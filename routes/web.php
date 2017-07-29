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
    
});
