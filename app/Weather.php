<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Naughtonium\LaravelDarkSky\DarkSky;

class Weather extends Model
{
    static function get($time)
    {

    	$unix_timestamp = Carbon::parse($time . 'EST')->timestamp;

    	$forecast = new DarkSky;

    	$forecast = $forecast->location(40.7833257,-73.9458661)->atTime($unix_timestamp)->includes(['currently', 'hourly'])->get();

        $daily_summary = $forecast->hourly->summary;
        $temp_at_game_time = floor(round($forecast->currently->temperature)) . '°';

        $game_hour = Carbon::parse($time . 'EST')->format('H');

        $precip_probabilities = [];

        foreach ($forecast->hourly->data as $hour => $hour_info) :
            
            array_push($precip_probabilities, $hour_info->precipProbability);

        endforeach;

    	return 

    	[
			'daily_summary' => $daily_summary,
            'temp_at_game_time' => $temp_at_game_time
    	];

    }


}
