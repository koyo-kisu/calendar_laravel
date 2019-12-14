<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//ホーム
Route::get('/', 'CalendarController@index');

//投稿ページ
Route::get('/holiday', 'CalendarController@getHoliday');

//投稿処理
Route::post('/holiday', 'CalendarController@postHoliday');

//更新処理
Route::get('/holiday/{id}', 'CalendarController@getHolidayId');

//削除処理
Route::delete('/holiday', 'CalendarController@deleteHoliday');
