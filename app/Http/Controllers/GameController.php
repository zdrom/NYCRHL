<?php

namespace App\Http\Controllers;

use App\Game;
use App\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{

	public function index(Team $team)
	{

		$games = $team->games();

		return Game::findNextGames($games);

	}

}
