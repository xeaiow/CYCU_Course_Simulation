<?php


Route::get('/login', 'LoginController@index');

Route::get('/', 'SimulationController@index');

Route::get('/search_course/{keywords}', 'SimulationController@searchCourse');

Route::post('/profile/save', 'SimulationController@saveProfile');

Route::get('/logout', 'SimulationController@logout');

Route::post('/course/save', 'SimulationController@saveCourse');

Route::get('/added_course', 'SimulationController@addedCourse');

Route::get('/import', 'SimulationController@importCourse');