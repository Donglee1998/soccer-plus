<?php

namespace App\Repositories;

use App\Repositories\Interfaces\NewsRepositoryInterface;
use App\Services\QueryService;
use Illuminate\Http\Request;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    public function model()
    {
        return \App\Models\News::class;
    }

    public function querylist($condition = [])
    {
        $limit  = config('constants.limit');
        $builder = $this->model;
        $builder = $builder->when($condition['search'], function($q) use($condition) {
            $q->where('title', 'LIKE', "%{$condition['search']}%");
        });
        if (@$condition['category']) {
            $builder = $builder->where('category', $condition['category']);
            if ($condition['category'] == config('constants.news_category.key.manual')) {
                $builder->orderBy('order', 'desc');
            }else{
                $builder->orderBy('id', 'desc');
            }
        }

        return $builder->paginate($limit);
    }


    public function toggleStatusList($list, $state)
    {
        return $this->model->whereIn('id', $list)->update(['is_public' => $state]);
    }

    public function adminGetDetail($condition = [])
    {
        $query = $this->model;
        if (@$condition['category']) {
            $query = $query->where('category', $condition['category']);
        }
        return $query->find($condition['id']);
    }

    public function getListNews()
    {
        $query = $this->model;
        $query = $query->where(function ($q) {
            $q->whereNull('is_draft');
            $q->orWhere('is_draft', '!=', 1);
        });
        $query = $query->where('is_public', config('constants.setting_public.key.public'));
        $query = $query->where('category', config('constants.news_category.key.news'));
        $query = $query->where(function ($q) {
            $q->where('start_date', '<=', now());
            $q->orWhereNULL('start_date');
        });
        $query = $query->where(function ($q) {
            $q->where('end_date', '>=', now());
            $q->orWhereNULL('end_date');
        });
        $query = $query->orderBy('public_date', 'desc');
        return $query->paginate(config('constants.per_page.default'));
    }

    public function getDetailNews($condition)
    {
        $query = $this->model;
        $query = $query->where('is_public', config('constants.setting_public.key.public'));
        $query = $query->where(function ($q) {
            $q->whereNull('is_draft');
            $q->orWhere('is_draft', '!=', 1);
        });
        $query = $query->where('category', $condition['category']);
        if (@$condition['sub_category']) {
            $query = $query->where('sub_category', $condition['sub_category']);
        }
        return $query->find($condition['id']);
    }

    public function getListManual()
    {
        $query = $this->model;
        $query = $query->where(function ($q) {
            $q->whereNull('is_draft');
            $q->orWhere('is_draft', '!=', 1);
        });
        $query = $query->where('is_public', config('constants.setting_public.key.public'));
        $query = $query->where('category', config('constants.news_category.key.manual'));
        $query = $query->orderBy('order', 'desc');
        return $query->get();
    }

    public function getOrder()
    {
        $order = $this->model->where('category', config('constants.news_category.key.manual'))->count();
        return $order + 1;
    }
}
