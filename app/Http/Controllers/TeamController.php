<?php

namespace App\Http\Controllers;

use App\AttendanceList;
use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}
	
    public function index(Team $team)
    {
        
    	$games = $team->games();

    	return view('team.index', compact('games', 'team'));

    }
}