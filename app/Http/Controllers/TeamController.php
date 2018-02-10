<?php

namespace App\Http\Controllers;

use App\AttendanceList;
use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Team $team)
    {
    	$games = $team->games();

    	$players = $team->players;

    	foreach ($games as $game => $game_info) :

    		foreach ($players as $player => $player_info) :
    			
    			AttendanceList::create([
 
    			    'team_id' => $team->id,
    			    'user_id' => $player_info['id'],
    			    'game_id' => $game_info['id']

    			]);

    		endforeach;

    	endforeach;

    	return view('team.index', compact('games'));

    }
}