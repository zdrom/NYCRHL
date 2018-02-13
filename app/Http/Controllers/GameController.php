<?php

namespace App\Http\Controllers;

use App\AttendanceList;
use App\Game;
use App\Team;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Naughtonium\LaravelDarkSky\DarkSky;

class GameController extends Controller
{

	public function index(Team $team, Game $game)
	{

		//converts date to unix timestamp which is required by the darksky API
		$gameTimestamp = Carbon::parse($game->date)->timestamp;

		$forecast = new DarkSky;

		$forecast = $forecast->location(40.7848427,-73.9514865)->atTime($gameTimestamp)->get('daily', 'currently');

		$attendanceList = AttendanceList::where('game_id', $game->id)
						  ->where('team_id', $team->id)
						  ->get();

		$attendance = [];

		foreach ($attendanceList as $response => $response_details) :
			
			$attendance[User::find($response_details['user_id'])->name] = $response_details['attending'];

		endforeach;

		return view('game.index', compact('team', 'game', 'chanceOfRainAtGameTime', 'attendance'));

	}

	public function cancel()
	{	

		$game = Game::find(request()->game_id);
		$game->canceled = 1;
		$game->note = request()->note;
		$game->save();

		return back();
		

	}

	public function reschedule()
	{

		$game = Game::find(request()->game_id);
		$game->canceled = 0;
		$game->note = NULL;
		$game->date = request()->date;
		$game->save();

		return back();

	}



}
