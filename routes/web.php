<?php

use App\event;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');
Route::post('/home', 'EventController@remove');

Route::get('/post-event', function () {
    return view('post-event');
});
Route::post('/create-event', 'EventController@create');

Route::get('/event/{event}', 'EventController@single');
Route::post('/event/{event}', 'EventController@add');

Route::get('/about', function () {
    return view('about');
});



Route::get('/browse', function () {
	$events = event::where('approved', 1)->get();
    return view('browse', compact('events'));
});
Route::post('/browse', 'EventController@filter');

Route::get('/hosted-events', 'EventController@hosted');
Route::post('/hosted-events/{id}', 'EventController@delete');

Route::get('/edit-event/{id}', 'EventController@editSingle');

Route::post('/edit-event/{id}', 'EventController@update');

Route::get('/admin', 'AdminController@users');
Route::get('/admin/events', 'AdminController@events');

Route::get('/promote/{id}', 'AdminController@promote');
Route::get('/demote/{id}', 'AdminController@demote');
Route::get('/approve/{id}', 'AdminController@approve');
Route::get('/suspend/{id}', 'AdminController@suspend');

Route::get('/makeAdmin', 'AdminController@makeAdmin');
Route::get('/calendar', 'calendarController@current');
Route::get('/calendar/{month}/{year}', 'calendarController@index');

Auth::routes();