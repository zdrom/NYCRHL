<?php

namespace App\Console\Commands;

use App\AttendanceList;
use App\Game;
use App\User;
use Illuminate\Console\Command;

class makeAttendanceList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AttendanceList:Create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the Attendance list for all games';

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
        $games = Game::all();

        foreach ($games as $game => $game_info) :
            foreach ($users as $user => $user_info) :
                
                AttendanceList::create([

                    'team_id' => $user_info['team_id'],
                    'user_id' => $user_info['id'],
                    'game_id' => $game_info['id'],

                ]);

            endforeach;
        endforeach;
    }
}
