<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Naughtonium\LaravelDarkSky\DarkSky;

class Weather extends Model
{
    static function gameTimeForecast($time)
    {

    	$unix_timestamp = Carbon::parse($time)->timestamp;

    	$forecast = new DarkSky;

    	$hourly = $forecast->location(40.7833257,-73.9458661)->atTime($unix_timestamp)->daily()[0];

    	return 

    	[
			'icon' => $hourly->icon,
			'summary' => $hourly->summary
    	];

    }
}
