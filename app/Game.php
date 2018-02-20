<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Game extends Model
{
    protected $fillable = [
        'id', 'home_team', 'away_team',  'date' ,'season'
    ];

    static function upNext()
    {

    	//All games for a users team
        $games = Auth::user()->team->games()
        ->toArray();

        $games = array_filter($games, function ($game)
        {
            //filter out games in the past
            if (Carbon::parse($game['date'] . 'EST')->isFuture()) {
                return true;
            } else {
                return false;
            }
        });

        $upNext = [];

        foreach ($games as $game => $game_info) :

            if (empty($upNext)) {

                array_push($upNext, $game_info);

            } else {

                $comparison = Carbon::parse($game_info['date'] . 'EST')->startOfDay()->diffInDays(Carbon::parse($upNext[0]['date'] . 'EST')->startOfDay(), false);

                switch (true) :

                    case $comparison == 0:
                        array_push($upNext, $game_info);
                        break;

                    case $comparison > 0:
                        $upNext = [$game_info];
                        break;

                endswitch;
            }

        endforeach;

        return $upNext;

    }
}
