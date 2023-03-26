<?php

namespace App\Repositories;

class TeamRepository extends BaseRepository
{
    public function model()
    {
        return \App\Models\Team::class;
    }

    public function getAllTeam($condition, $columns = ['*'])
    {
        $builder = $this->model;
        $builder = $builder->select($columns);
        if (@$condition['created_by']) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        $builder = $builder->orderBy('order_number', 'desc')->get();
        return $builder;
    }

    public function getTeamIsHome($created_by)
    {
        $builder = $this->model;
        $builder = $builder->where('is_home', config('constants.is_home'))
        ->where('created_by', $created_by)
        ->first();
        return $builder;
    }


    public function getListExceptIsHome($auth_id)
    {
        return $this->model->where('created_by', $auth_id)->whereNull('is_home')->get();
    }

    public function getListSync($condition = [])
    {
        $builder = $this->model;
        $builder = $builder->select('id', 'updated_at');
        if (@$condition['
            ']) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        $builder = $builder->get()->pluck('updated_at', 'id')->toArray();
        return $builder;
    }

    public function getList($condition = [], $columns = ['*'])
    {
        $builder = $this->model;
        $builder = $builder->select($columns);

        if (!empty($condition['created_by'])) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        $builder = $builder->orderByDesc('is_home')->orderBy('created_at');

        return $builder->paginate(config('constants.per_page.default'));
    }

    public function findTeam($condition = [], $columns = ['*'])
    {
        $builder = $this->model;
        $builder = $builder->select($columns);

        if (!empty($condition['id_team'])) {
            $builder = $builder->where('id', $condition['id_team']);
        }

        if (!empty($condition['created_by'])) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        if (!empty($condition['is_home'])) {
            $builder = $builder->where('is_home', $condition['is_home']);
        }

        $builder = $builder->first();

        return $builder;
    }
}
