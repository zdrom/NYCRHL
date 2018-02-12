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

Route::get('attending', function() {
    

	// $user_id = Input::get('user');
	$game_id = Input::get('game');
	// $attending = Input::get('attending');

	$gameDate = Game::where('id', $game_id)
			->value('date');

	Nexmo::message()->send([
	    'to'   => '19144621639',
	    'from' => '12023502861',
	    'text' => 'The next game is ' . $gameDate . '

		If you are able to attend, click here:

		LINK

		If not, click here:

		LINK

	    '
	]);

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
