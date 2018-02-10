<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceList extends Model
{
   protected $fillable = [
       'team_id', 'user_id', 'game_id', 'attending', 'note'
   ];
}
