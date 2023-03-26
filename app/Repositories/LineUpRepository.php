<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Member;
use App\Models\Tournament;

class LineUpRepository extends BaseRepository
{
    public function model()
    {
        return \App\Models\Lineup::class;
    }

    public function findInWeb($id, $columns = ['*'])
    {
        $builder = $this->model->with(['team' => function ($query) {
            $query->withTrashed()->select(['id', 'color_home', 'color_guest', 'name', 'order_number']);
        }, 'team.members' => function ($query) {
            $query->withTrashed()->select('team_id', 'first_name', 'last_name', 'position', 'number_official', 'number_practice', 'id');
        }]);

        $builder = $builder->select($columns)->withTrashed();
        $builder = $builder->find($id);
        return $builder;
    }

    public function getListSync($condition = [])
    {
        $builder = $this->model;
        $builder = $builder->select('id');
        if (@$condition['created_by']) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        if (@$condition['team_id']) {
            $builder = $builder->where('team_id', $condition['team_id']);
        }
        $builder = $builder->pluck('id', 'id')->toArray();
        return $builder;
    }

    public function getAllLineup($condition)
    {
        $builder = $this->model;
        $builder = $builder->select('*');
        if (@$condition['created_by']) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        if (@$condition['team_id']) {
            $builder = $builder->where('team_id', $condition['team_id']);
        }
        $builder = $builder->get();
        return $builder;
    }
}
