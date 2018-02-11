<?php

namespace App\Console\Commands;

use App\Game;
use Goutte;
use Carbon\Carbon;
use Illuminate\Console\Command;

class checkSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Schedule:Check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the schedule to make sure the Games table in the DB is up to date';

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

        $crawler = Goutte::request('GET', 'http://nycrhl-stats.wttstats.pointstreak.com/players-team-schedule.html?teamid=521499&seasonid=17404');

        $crawler->filter('tbody > tr')->each(function ($node) {

            //Convert the date and time from the website to one value
            $date = $node->filter('td')->eq(5)->text();
            $time = $node->filter('td')->eq(6)->text();
            $dateTime = Carbon::parse($date . $time  . ' 2017');

            //The Game ID
            $id = intval($node->filter('td')->eq(0)->text());

            //If the game is not in the DB, add it
            if (!Game::find($id)) {

                preg_match('/\D*/', $node->filter('td')->eq(2)->text(), $matches);

                $home_team = trim($matches[0]);

                preg_match('/\D*/', $node->filter('td')->eq(4)->text(), $matches);

                $away_team = trim($matches[0]);

                Game::create([

                    'id' => intval($node->filter('td')->eq(0)->text()),
                    'home_team' => $home_team,
                    'away_team' => $away_team,
                    'date' => $dateTime,
                    'season' => 'SPRING2018'

                ]);
            
            //If the game is in the DB, check to see if the date or time have changed. If it has, update the DB
            } else {

                if ($dateTime->ne(Carbon::parse(Game::find($id)->date))) :

                    $game = Game::find($id);
                    
                    $game->date = $dateTime;

                    $game->save();

                endif;

            }

        });
    }
}
