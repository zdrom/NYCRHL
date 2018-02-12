<?php

use App\AttendanceList;
use App\Game;
use Illuminate\Support\Facades\Input;
use Nexmo\Laravel\Facade\Nexmo;

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

Route::get('team/{team}', 'TeamController@index');

Route::get('team/{team}/next', 'GameController@index');

Route::get('team/{team}/game/{game}', 'GameController@index');

Route::get('rollCall', 'AttendanceListController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');