<?php

namespace Tests\Unit;

use App\Helpers\Constants;
use Tests\TestCase;

class TeamArrangementTest extends TestCase
{

    public function testArrangeForTeamSize()
    {
        $this->artisan(Constants::COMMAND_SIGNATURE)
            ->expectsQuestion(Constants::ENTER_TEAM_A, '30,30,40,100')
            ->expectsQuestion(Constants::ENTER_TEAM_B, '40,50,60,79,78')
            ->expectsOutput(Constants::TEAM_LENGTH_ERROR)
            ->assertExitCode(0);

    }

    public function testArrangeForTeamAWin()
    {
        $this->artisan(Constants::COMMAND_SIGNATURE)
            ->expectsQuestion(Constants::ENTER_TEAM_A, '80,40,90,100,78')
            ->expectsQuestion(Constants::ENTER_TEAM_B, '40,50,60,79,78')
            ->expectsOutput(Constants::WIN_STATUS)
            ->assertExitCode(0);

    }

    public function testArrangeForTeamALose()
    {
        $this->artisan(Constants::COMMAND_SIGNATURE)
            ->expectsQuestion(Constants::ENTER_TEAM_A, '40,40,90,100,78')
            ->expectsQuestion(Constants::ENTER_TEAM_B, '40,50,60,79,78')
            ->expectsOutput(Constants::LOSE_STATUS)
            ->assertExitCode(0);

    }
}
