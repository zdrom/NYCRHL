<?php

use App\User;
use Carbon\Carbon;

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

Route::get('/', function ()
{

	return redirect()->route('home');

});

Route::get('team/{team}', 'TeamController@index');

Route::get('team/{team}/next', 'GameController@nextGame');

Route::get('team/{team}/game/{game}', 'GameController@index');
Route::post('game/cancel', 'GameController@cancel');
Route::post('game/reschedule', 'GameController@reschedule');

Route::get('player/status', 'AttendanceListController@status_get');
Route::post('player/status', 'AttendanceListController@status_post');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');