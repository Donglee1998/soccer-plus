<?php
namespace App\Repositories;

use App\Repositories\Interfaces\TacticRepositoryInteface;

class TacticRepository extends BaseRepository implements TacticRepositoryInteface
{
    public function model()
    {
        return \App\Models\Tactic::class;
    }

    public function getList($condition = [])
    {
        $builder = $this->model;
        $builder = $builder->where('created_by', $condition['created_by']);

        $builder = $builder->with(['sheets' => function ($query) {
            $query->select('sketch', 'tactic_id');
        }]);

        $builder = $builder->orderBy('created_at')->paginate(15);

        return $builder;
    }

    public function getTacticDetail($condition = [])
    {
        $builder = $this->model;
        if (@$condition['created_by']) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        if (@$condition['tactic_id']) {
            $builder = $builder->where('tactic_id', $condition['tactic_id']);
        }
        if (@$condition['uuid']) {
            $builder = $builder->where('uuid', $condition['uuid']);
        }
        if (@$condition['id_tactic']) {
            $builder = $builder->where('id', $condition['id_tactic']);
        }
        $builder = $builder->first();
        return $builder;
    }

    public function deleteTactic($condition = [])
    {
        $builder = $this->model;

        if (!empty($condition['array_id_tactic']) && !empty($condition['created_by'])) {
            $builder = $builder->where('created_by', $condition['created_by'])->whereIn('id', $condition['array_id_tactic'])->delete();
        }

        return true;
    }

}
