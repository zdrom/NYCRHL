<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'id', 'home_team', 'away_team',  'date' ,'season'
    ];

    static function findNextGames($arr)
    {

    	$nextGame = [$arr[0]];

    	foreach ($arr as $game => $game_info) {

    		if (count($nextGame) == 0) {

    			if (Carbon::now()->lt(Carbon::parse($game_info['date']))) :
    				
    				array_push($nextGame, $game_info);

    			endif;

    		} else {

    			return 'hello';

    		}


    	}

    	return $nextGame;

    }
}
