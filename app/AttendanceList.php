<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceList extends Model
{
   protected $fillable = [
       'team_id', 'user_id', 'game_id', 'attending', 'note'
   ];

   static function getAttendance($games, $team_id)
   {

   	$attendance = [];

   	if (is_array($games)) {

   		foreach ($games as $game) :

   			$attendance[$game['id']] = array();

   			$attendanceList = AttendanceList::where('team_id', $team_id)
   			->where('game_id', $game['id'])
   			->get();

   			foreach ($attendanceList as $response => $response_details) :

   				$attendance[$game['id']][User::find($response_details['user_id'])->name] = $response_details['attending'];

   			endforeach;

   		endforeach;

   	} else {

   		$game = $games; //correct nomenclature 

   		$attendanceList = AttendanceList::where('team_id', $team_id)
   		->where('game_id', $game['id'])
   		->get();

   		foreach ($attendanceList as $response => $response_details) :

   			$attendance[User::find($response_details['user_id'])->name] = $response_details['attending'];

   		endforeach;

   	}

   	return $attendance;

   }

}