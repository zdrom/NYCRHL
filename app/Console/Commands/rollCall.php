<?php

namespace App\Console\Commands;

use App\AttendanceList;
use App\Game;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Nexmo\Laravel\Facade\Nexmo;

class RollCall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Schedule:RollCall';

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

        $currentDate = Carbon::now('America/New_York')->format('Y\-m\-d H\:i\:s');
        
        //Get all games that have not already been played
        $games = Game::whereDate('date', '>=', $currentDate)
        ->get()
        ->toArray();

        //Get all games that have not already been played and are within 5 weekdays from the current date
        

        $upcomingGames = array_filter($games, function ($game)
        {
            if (Carbon::now('America/New_York')->diffInWeekdays(Carbon::parse($game['date'])) <= 5) :
                return true;
            endif;
        });

        //loop through all upcoming games and check for an attending response for each player. If no response, send a text asking the player if he can make it
        foreach ($upcomingGames as $game => $game_details) :

            $attendance_list = AttendanceList::where('game_id', $game_details['id'])
            ->get();

            foreach ($attendance_list as $response => $response_details) :

                if ($response_details->attending == 'NR') :

                    $user = User::find($response_details['user_id']);
                    
                    Nexmo::message()->send([
                        'to'   => $user->phone,
                        'from' => '12023502861',
                        'text' => Carbon::parse($game_details['date'])->format('D, M j \a\t h:m a') . "\n\nCan you make it?\n\nYes\n" . env('APP_URL') . "/rollCall?&attendance_id=" . $response_details['id'] . "&attending=yes" . "\n\nNo\nLink"
                    ]); 

                endif;
                
            endforeach;

        endforeach;


    }
}
