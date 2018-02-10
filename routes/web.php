<?php

use App\Game;
use Carbon\Carbon;
use Naughtonium\LaravelDarkSky\DarkSky;

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

Route::get('/weather', function() {

});