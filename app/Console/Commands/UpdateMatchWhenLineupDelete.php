<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tournament;
use App\Models\Lineup;
use App\Models\Team;
use App\Models\Member;

class UpdateMatchWhenLineupDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:match';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update match when lineup delete';

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
     * @return int
     */
    public function handle()
    {
        // try {
            
            //matches
            $matches = Tournament::select('id', 'lineup_id1', 'lineup_id2', 'team_id1', 'team_id2')->withTrashed()->get();
            foreach ($matches as $key => $match) {
                if ($match->team_id1) {
                    $team = Team::withTrashed()->find($match->team_id1);
                    if (!$team) {
                        $match->forceDelete();
                    }
                }

                if ($match->team_id2) {
                    $team = Team::withTrashed()->find($match->team_id2);
                    if (!$team) {
                        $match->forceDelete();
                    }
                }

                if ($match->lineup_id1) {
                    $lineup1 = Lineup::withTrashed()->find($match->lineup_id1);
                    if (!$lineup1) {
                        $match->update(['lineup_id1' => null]);
                    }
                }
                if ($match->lineup_id2) {
                    $lineup2 = Lineup::withTrashed()->find($match->lineup_id2);
                    if (!$lineup2) {
                        $match->update(['lineup_id2' => null]);
                    }
                }
            }

            $lineups = Lineup::select('id', 'team_id')->withTrashed()->get();
            foreach ($lineups as $key => $lineup) {
                if ($lineup->team_id) {
                    $team = Team::withTrashed()->find($lineup->team_id);
                    if (!$team) {
                        $lineup->forceDelete();
                    }
                }
            }

            $members = Member::select('id', 'team_id')->withTrashed()->get();
            foreach ($members as $key => $member) {
                if ($member->team_id) {
                    $team = Team::withTrashed()->find($member->team_id);
                    if (!$team) {
                        $member->forceDelete();
                    }
                }
            }

            return true;
        // } catch (\Throwable $th) {
        //     print_r("\nLine: " . $th->getLine() . "\n");
        //     print_r($th->getMessage() . "\n");
        // }
    }
}
