<?php
namespace App\Repositories;
use App\Models\Team;

class MemberRepository extends BaseRepository
{

    public function model()
    {
        return \App\Models\Member::class;
    }

    public function getList($condition = [])
    {
        $builder = $this->model;
        if (!empty($condition['team_id'])) {
            $builder = $builder->where('team_id', $condition['team_id']);
        }
        $builder = $builder->orderByDesc('created_at');
        $data = $builder->paginate(config('constants.limit'));
        return $data;
    }

    public function memberOfTeam($condition, $columns = ['*'])
    {
        $builder = $this->model;
        $builder = $builder->select($columns);

        if (!empty($condition['team_id'])) {
            $builder = $builder->where('team_id', $condition['team_id']);
        }
        if (@$condition['created_by']) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }

        $builder = $builder->orderByRaw('CONVERT(number_official, SIGNED) asc');

        return $builder->paginate(config('constants.per_page.default'));
    }

    public function getMemberStats($team_id)
    {
        $builder = $this->model;
        $builder = $builder->select('id', 'team_id', 'first_name', 'last_name', 'position', 'sub_position', 'number_official', 'number_practice');
        $builder = $builder->where('team_id', $team_id);
        return $builder->orderByRaw('-number_official desc');
    }

    public function getMemberScoreBookStats($team_id, $member_ids)
    {
        return $builder = $this->model->where('team_id', $team_id)->whereIn('id', $member_ids)->orderByRaw('CAST(number_official AS DECIMAL) asc');
    }


    public function getListSync($condition = [])
    {
        $builder = $this->model;
        $builder = $builder->select('id', 'updated_at');
        if (@$condition['created_by']) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        $builder = $builder->pluck('updated_at', 'id')->toArray();
        return $builder;
    }

    public function getAllMember($condition)
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

    public function getDetail($condition, $columns = ['*'])
    {
        $builder = $this->model;
        $builder = $builder->select($columns);

        if (!empty($condition['team_id'])) {
            $builder = $builder->where('team_id', $condition['team_id']);
        }
        if (!empty($condition['created_by'])) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        if (!empty($condition['member_id'])) {
            $builder = $builder->where('id', $condition['member_id']);
        }

        $builder = $builder->with([
            'team' => function ($query) {
                $query->select('id', 'name', 'color_home');
            },
        ]);

        return $builder->first();
    }
}
