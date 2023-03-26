<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;

class VideoRepository extends BaseRepository
{
    public function model()
    {
        return \App\Models\Video::class;
    }

    public function list($condition = [], $columns = ['videos.*'], $page_number = null)
    {
        $builder = $this->model;
        $builder = $builder->select($columns);

        if (!empty($condition['created_by'])) {
            $builder = $builder->where('videos.created_by', $condition['created_by']);
            $builder = $builder->leftJoin('folders', 'folders.id', '=', 'videos.folder_id');
            $builder = $builder->where('folders.created_by', $condition['created_by']);
        }

        if (!empty($condition['folder_id'])) {
            $builder = $builder->where('folder_id', $condition['folder_id']);
        }

        $builder = $builder->orderBy('id', 'desc');

        if($page_number) {
            return $builder->paginate(config('constants.per_page.default'), $columns, null,$page = $page_number);
        }

        if(isset($condition['is_append']) && ($condition['is_append'] === true)) {
            return $builder->get()->each->append('url');
        }

        if(isset($condition['is_pagination']) && ($condition['is_pagination'] === false)) {
            return $builder->get();
        }

        return $builder->paginate(config('constants.per_page.default'));
    }

    public function deleteVideo($condition = [])
    {
        $builder = $this->model;

        if (!empty($condition['array_id_video']) && !empty($condition['created_by'])) {
            $builder = $builder->where('created_by', $condition['created_by'])->where('folder_id', $condition['folder_id'])->whereIn('id', $condition['array_id_video']);

            $builder_tmp = $builder;
            // Remove file S3
            delFileS3(array_merge($builder_tmp->get()->pluck('path')->toArray(), $builder_tmp->get()->pluck('thumbnail')->toArray()));
            $builder->delete();

            \App\Models\StatsVideos::whereIn('video_id', $condition['array_id_video'])->delete();
        }

        return true;
    }

    public function deleteVideoFollowFolder($condition = [])
    {
        $builder = $this->model;

        if (!empty($condition['array_id_folder']) && !empty($condition['created_by'])) {
            $builder = $builder->where('created_by', $condition['created_by'])->whereIn('folder_id', $condition['array_id_folder']);

            $builder_tmp = $builder;
            // Remove file S3
            delFileS3(array_merge($builder_tmp->get()->pluck('path')->toArray(), $builder_tmp->get()->pluck('thumbnail')->toArray()));
            $builder->delete();
        }

        return true;
    }

    public function findVideo($condition = [])
    {
        $builder = $this->model;

        $builder = $builder->where('id', $condition['video_id']);
        
        $builder = $builder->where('created_by', $condition['created_by']);

        $builder = $builder->with([
            'folder' => function ($query) {
                $query->select('id', 'name');
            }
        ]);

        $builder = $builder->first();

        return $builder;
    }
}
