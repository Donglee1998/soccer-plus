<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;

class FolderRepository extends BaseRepository
{
    public function model()
    {
        return \App\Models\Folder::class;
    }

    public function list($condition = [], $columns = ['*'], $page_number = null)
    {
        $builder = $this->model;
        $builder = $builder->select($columns);

        if (!empty($condition['created_by'])) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }

        $builder = $builder->orderBy('id', 'desc');

        if($page_number) {
            return $builder->paginate(config('constants.per_page.default'), $columns, null, $page = $page_number);
        }

        if(isset($condition['is_pagination']) && ($condition['is_pagination'] === false)) {
            return $builder->get();
        }

        return $builder->paginate(config('constants.per_page.default'));
    }

    public function deleteFolder($condition = [])
    {
        $builder = $this->model;

        if (!empty($condition['array_id_folder']) && !empty($condition['created_by'])) {
            $builder = $builder->where('created_by', $condition['created_by'])->whereIn('id', $condition['array_id_folder'])->delete();
        }

        return true;
    }

    public function findFolder($condition = [])
    {
        $builder = $this->model;

        $builder = $builder->where('id', $condition['folder_id']);

        $builder = $builder->where('created_by', $condition['created_by']);

        $builder = $builder->first();

        return $builder;
    }
}
