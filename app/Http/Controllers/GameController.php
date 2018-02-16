<?php

namespace App\Http\Controllers;

use App\AttendanceList;
use App\Game;
use App\Team;
use App\User;
use App\Weather;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

	public function index(Team $team, Game $game)
	{

		// $forecast = Weather::get($game->date);

		//Gets the attendance given a game or games and the team id
		$attendance = AttendanceList::getAttendance($game, $team->id);

		//Convert to array to use the attendance blade view
		$game = $game->toArray();

		return view('game.index', compact('team', 'game', 'attendance'));

	}

	public function nextGame(Team $team)
	{

		//returns an array of the games closest to the current date in the form of an array. Most of the time this will be a single value but can be more
		$games = Game::upNext();

		$forecast = Weather::get($games[0]['date']);

		//Takes games or a game and a team id to get an attendance list
		$attendance = AttendanceList::getAttendance($games, Auth::user()->team_id);

		return view('game.upNext', compact('games', 'attendance', 'team', 'forecast'));

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
