<?php
namespace App\Repositories;
use App\Models\Comment;

class CommentRepository extends BaseRepository
{

    public function model()
    {
        return \App\Models\Comment::class;
    }

    public function getDetail($condition)
    {
        $builder = $this->model;

        if (@$condition['match_id']) {
            $builder = $builder->where('match_id', $condition['match_id']);
        }

        if (@$condition['created_by']) {
            $builder = $builder->where('created_by', $condition['created_by']);
        }
        return $builder->first();
    }
}
