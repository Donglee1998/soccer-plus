<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;

class StatsVideoRepository extends BaseRepository
{
    public function model()
    {
        return \App\Models\StatsVideos::class;
    }

    public function updateOrCreate($where, $update)
    {
        return $this->model->updateOrCreate($where, $update);
    }
}
