<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'id', 'home_team', 'away_team',  'date' ,'season'
    ];
}
