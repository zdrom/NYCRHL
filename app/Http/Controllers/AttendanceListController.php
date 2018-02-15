<?php

namespace App\Http\Controllers;

use App\AttendanceList;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AttendanceListController extends Controller
{
    public function status_post()
    {

    	$input = Input::all();

    	$response = AttendanceList::where('game_id', $input['game_id'])
        ->where('user_id', Auth::id())
        ->first();

    	$response['attending'] = $input['status'];

    	$response->save();

    	return back();

    }

    public function status_get()
    {
        $response = AttendanceList::where('game_id', request()->game_id)
        ->where('user_id', request()->user_id)
        ->first();

        $response['attending'] = request()->status;

        $response->save();

        if (Auth::check()) :
            return redirect('/team/' . Team::find(Auth::user()->team_id)->id . '/game/' . request()->game_id);
        endif;
    }

}
