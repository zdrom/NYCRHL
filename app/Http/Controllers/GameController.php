<?php

namespace App\Http\Controllers;

use App\AttendanceList;
use App\Game;
use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Naughtonium\LaravelDarkSky\DarkSky;

class GameController extends Controller
{

	public function index(Team $team, Game $game)
	{

		//converts date to unix timestamp which is required by the darksky API
		$gameTimestamp = Carbon::parse($game->date)->timestamp;

		$forecast = new DarkSky;

		$forecast = $forecast->location(40.7848427,-73.9514865)->atTime($gameTimestamp)->currently();

		$chanceOfRainAtGameTime = $forecast->precipProbability * 100 . '%';

		$attendanceList = AttendanceList::where('game_id', $game->id)
						  ->where('team_id', $team->id)
						  ->get();

		return view('game.index', compact('team', 'game', 'chanceOfRainAtGameTime', 'attendanceList'));

	}

}
