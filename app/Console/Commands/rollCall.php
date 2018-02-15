<?php

namespace App\Console\Commands;

use Twilio;
use App\AttendanceList;
use App\Game;
use App\Team;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Shortener;

class RollCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AttendanceList:RollCall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends out a text message to anyone who has not yet updated their status for the specified game';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $users = User::all();

        foreach ($users as $user => $user_info) :
            
            //get the team ID
            $team = Team::find($user_info['team_id']);

            //Get all the games for that team
            $games = $team->games();

            $current_time = Carbon::now('America/New_York');

            //This will store all the games within the next 5 weekdays where the user has not responded
            $upcoming_games_with_no_response = [];

            foreach ($games as $game => $game_info) :

                //If the game is within the next 5 weekdays
                if (Carbon::parse($game_info->date . 'EST')->diffInWeekdays($current_time) <= 5 && Carbon::parse($game_info->date . 'EST')->diffInWeekdays($current_time) >= 0) :


                    $attending = AttendanceList::where('user_id', $user_info['id'])
                    ->where('game_id', $game_info->id)
                    ->value('attending');

                    //If the user has not responded with a status
                    if ($attending == 'NR') :
                        array_push($upcoming_games_with_no_response, $game_info);
                    endif;

                endif;

            endforeach;

            if (!count($upcoming_games_with_no_response)) :
               continue;
            endif;

            $gameOrGames = (count($upcoming_games_with_no_response) !== 1) ? "games" : "game";

            $message = "🏒" .  Team::find($user_info['team_id'])->name . "🏒" . "\n\nYou have " . count($upcoming_games_with_no_response) . " upcoming " . $gameOrGames . "\n\n";

            foreach ($upcoming_games_with_no_response as $game => $game_info) :
                $message .= Carbon::parse($game_info['date'])->format('M j \a\t g:i a') . "\n\n";
                $message .= "In\n";
                $message .= Shortener::shorten(env('APP_URL') . '/player/status?user_id=' . $user_info['id'] . '&game_id=' . $game_info['id'] . '&status=yes') . "\n\n";
                $message .= "Out\n";
                $message .= Shortener::shorten(env('APP_URL') . '/player/status?user_id=' . $user_info['id'] . '&game_id=' . $game_info['id'] . '&status=no') . "\n\n";

            endforeach;
            
            Twilio::message($user_info['phone'], $message);

        endforeach;

    }
}