<?php
namespace App\Repositories;

class MatchHistoryRepository extends BaseRepository
{

    public function model()
    {
        return \App\Models\MatchHistory::class;
    }

    public function getList($match_id)
    {
        $builder = $this->model;
        $builder = $builder->where('match_id', $match_id);
        $builder = $builder->orderByDesc('created_at')->get();
        return $builder;
    }
}
