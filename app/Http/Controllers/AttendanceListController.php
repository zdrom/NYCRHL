<?php

namespace App\Http\Controllers;

use App\AttendanceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AttendanceListController extends Controller
{
    public function index()
    {

    	$input = Input::all();

    	$response = AttendanceList::find($input['attendance_id']);

    	$response['attending'] = $input['attending'];

    	$response->save();

    	return redirect('/team/' . Auth::user()->team_id);

    }

    public function status()
    {

        //This route is hit via a form on the game page or via a url clicked in a text message. The text message does not require the user to be logged in and passes a user id. The form request requires the user to be logged in and does not pass user_id
        $user_id = (request()->user_id) ? request()->user_id : Auth::id();

    	$response = AttendanceList::where('user_id', $user_id)
    	->where('game_id', request()->game_id)
    	->first();

    	$response->attending = request()->status;

    	$response->save();

    	return back();

    }
}
