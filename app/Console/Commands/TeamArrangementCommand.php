<?php

namespace App\Console\Commands;

use App\Helpers\Constants;
use Illuminate\Console\Command;

class TeamArrangementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Constants::COMMAND_SIGNATURE;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to arrange the team as per the drain score';

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
        $teamA = explode(',', $this->ask(Constants::ENTER_TEAM_A));
        $teamB = explode(',', $this->ask(Constants::ENTER_TEAM_B));

        $teamA = array_map('trim', $teamA);
        $teamB = array_map('trim', $teamB);

        if(count($teamA) != Constants::TEAM_LENGTH || count($teamB) != Constants::TEAM_LENGTH) {
            $this->error(Constants::TEAM_LENGTH_ERROR);
            return;
        }


        $finalTeamA = [];

        sort($teamA);

        $teamAStatus = Constants::WIN_STATUS;
        foreach($teamB as $teamBPlayer)
        {
            $isAdded = 0;
            foreach($teamA as $key=>$teamAPlayer) {
                if($teamAPlayer >= $teamBPlayer && !in_array($key, $finalTeamA)) {
                    $finalTeamA[] = $key;
                    $isAdded = 1;
                    break;
                }
            }
            if(!$isAdded) {
                $teamAStatus = Constants::LOSE_STATUS;
                break;
            }

        }

        $this->info($teamAStatus);
    }
}
