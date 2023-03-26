<?php
namespace App\Repositories;

class StatHistoryRepository extends BaseRepository
{
    public function model()
    {
        return \App\Models\StatHistory::class;
    }

    public function getList($match_id)
    {
        $builder = $this->model;
        $builder = $this->model->whereHas('stat.match', function ($builder) use ($match_id) {
            $builder->where('id', $match_id);
        });

        $builder = $builder->with([
            'stat' => function ($query) {
                $query->select('id', 'action_id', 'action_created', 'created_at_round', 'match_id', 'member_id');
            },
        ]);

        $builder = $builder->orderByDesc('created_at')->get();

        return $builder;
    }
}
