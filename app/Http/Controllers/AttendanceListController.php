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
    	$response = AttendanceList::where('user_id', Auth::id())
    	->where('game_id', request()->game_id)
    	->first();

    	$response->attending = request()->status;

    	$response->save();

    	return back();

    }
}
