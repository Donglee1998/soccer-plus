<?php
namespace App\Repositories;

class StatRepository extends BaseRepository
{
    public function model()
    {
        return \App\Models\Stat::class;
    }

    public function getStats($match_id)
    {
        return $this->model->whereIn('match_id', $match_id)->get();
    }

    public function getStatsTeam($match_id)
    {
        return $this->model->where('match_id', $match_id)->with('member')->get();
    }

    public function getStatsTeamByTimePeriodInRound($match_id, $round, $time, $sub_time)
    {
        $rounds  = [1 => '_1ST', 2 => '_2ND', 3 => '_3RD', 4 => '_4TH', 5 => '_EXT1', 6 => '_EXT2'];
        $builder = $this->model->where('match_id', $match_id);
        if ($round) {
            $builder = $builder->where('created_at_round', $rounds[$round]);
        }
        if ($sub_time) {
            $ms_in_round1 = $time * 60000 / 3;
            $ms_in_round2 = $time * 60000 / 3 * 2;
            if ($sub_time == 1) {
                $builder = $builder->where('timer_at', '<=', $ms_in_round1);
            } else if ($sub_time == 2) {
                $builder = $builder->where('timer_at', '>', $ms_in_round1)->where('timer_at', '<=', $ms_in_round2);
            } else {
                $builder = $builder->where('timer_at', '>', $ms_in_round2);
            }
        }
        return $builder->get();
    }

    public function getStatsTeams($match_id, $round)
    {
        $rounds  = [1 => '_1ST', 2 => '_2ND', 3 => '_3RD', 4 => '_4TH', 5 => '_EXT1', 6 => '_EXT2'];
        $builder = $this->model->whereIn('match_id', $match_id);
        if ($round) {
            $builder = $builder->where('created_at_round', $rounds[$round]);
        }
        return $builder->get();
    }
}
