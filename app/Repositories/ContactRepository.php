<?php
namespace App\Repositories;
use App\Models\Contact;

class ContactRepository extends BaseRepository
{

    public function model()
    {
        return \App\Models\Contact::class;
    }

    public function querylist($condition, $columns = ['*'])
    {
        $builder = $this->model;

        $builder = $builder->select($columns);

        $builder = $builder->when(!empty($condition['search']), function ($query) use ($condition) {
            $query = $query->where(function ($query1) use ($condition) {
                $query1->where('name', 'LIKE', "%{$condition['search']}%")
                        ->orWhere('email', 'LIKE', "%{$condition['search']}%")
                        ->orWhere('team', 'LIKE', "%{$condition['search']}%")
                        ->orWhere('content', 'LIKE', "%{$condition['search']}%");
            });
        });

        if (@$condition['status'] != '') {
            $builder = $builder->where('status', $condition['status']);
        }

        $builder = $builder->orderBy('created_at', 'desc');

        return $builder->paginate(config('constants.per_page.default'));
    }
}
