<?php

namespace App;

use App\Game;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function players()
    {
        return $this->hasMany('App\User');
    }

    public function games()
    {
    	return 

    	Game::where('home_team', $this->name)
    	->orWhere('away_team', $this->name)
    	->get();
    	
    }
}
