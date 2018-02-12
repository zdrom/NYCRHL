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

    	return view('team.index', compact('games'));

    }
}