<?php


Route::get('/login', 'LoginController@index');

Route::get('/', 'SimulationController@index');

Route::get('/search/course/{keywords}', 'SimulationController@searchCourse');

Route::post('/save/profile', 'SimulationController@saveProfile');