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

        $game_hour = Carbon::parse($time . 'EST')->hour;

        $precip_probabilities = [];
        $precip_probability_labels = [];

        for($i = 0; $i <= $game_hour; $i++) :

        $hour = $forecast->hourly->data[$i];

        array_push($precip_probabilities, $hour->precipProbability * 100);
        array_push($precip_probability_labels, Carbon::createFromTime($i)->format('g a'));

        endfor;

    	return 

    	[
			'daily_summary' => $daily_summary,
            'temp_at_game_time' => $temp_at_game_time,
            'precip_probability_labels' => json_encode($precip_probability_labels),
            'precip_probabilities' => json_encode($precip_probabilities)
    	];

    }


}
