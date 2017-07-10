<?php


Route::get('/login', 'LoginController@index');

Route::get('/', 'SimulationController@index');

Route::get('/search_course/{keywords}', 'SimulationController@searchCourse');

Route::post('/profile/save', 'SimulationController@saveProfile');

Route::get('/logout', 'SimulationController@logout');

Route::post('/course/save', 'SimulationController@saveCourse');

Route::get('/added_course', 'SimulationController@addedCourse');

Route::get('/minus_course/{course_id}', 'SimulationController@minusCourse');

Route::get('/import', 'SimulationController@importCourse');

// Route::get('/welcome', function() {

//     // $crawler = Goutte::request('GET', 'https://itouch.cycu.edu.tw/');
//     // $crawler->filterXPath('//a[contains(@class, "PostEntry_unread_")]')->each(function ($node) {
//     //   echo json_encode($node->text());
//     // });

//     $crawler = Goutte::request('GET', 'https://selene.tw/a');

//     return $result = $crawler->filter('.ui .raised .fluid .card')->each(function ($node){
//         return $posts[] = $node->text();
//     });
  
//     return view('simulation.crawler');
// });