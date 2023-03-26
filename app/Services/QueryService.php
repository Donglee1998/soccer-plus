<?php

namespace App\Services;

use Illuminate\Support\Arr;

class QueryService
{
    /**
     * Select column owner
     * @var array
     */
    public $select = [];

    /**
     * Column to search using whereLike
     * @var array
     */
    public $columnSearch = [];

    /**
     * Relationship with other tables
     * @var array
     */
    public $withRelationship = [];

    /**
     * Where with other condition
     * @var array
     */
    public $withOrWhere = [];

    /**
     * Paragraph search in column
     * @var ?string
     */
    public $search;

    /**
     * ascending, descending
     * @var ?string
     */
    public $ascending = 'DESC';

    /**
     * Column to order
     * @var string
     */
    public $orderBy = 'created_at';


    /**
     * Column to order
     * @var string
     */
    public $scope = [];

    /**
     * Eloquent model
     * @var Builder|Model $model
     */
    public $builder;

    /**
     * QueryService constructor.
     * @param $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     * Query table
     * @return mixed
     */
    public function queryTable()
    {
        $builder = $this->builder;

        $builder = $builder->when($this->select, function($q) {
            $q->select($this->select);
        });

        $builder = $builder->when($this->withOrWhere, function ($q) {
            foreach($this->withOrWhere as $where) {
                $idx = count($where) >= 3 ? 2 : 1;
                if (!empty($where[$idx])) {
                    $q->orWhere([$where]);
                }
            }
        });

        $builder = $builder->when($this->search, function($q) {
            foreach (Arr::wrap($this->columnSearch) as $column) {
                if (is_array($column)) {
                    foreach ($column as $col_item) {
                        foreach (str_split($this->search) as $char) {
                            $q->orWhere($col_item, 'LIKE', "%{$char}%");
                        }
                    }
                } else {
                    $q->orWhere($column, 'LIKE', "%{$this->search}%");
                }
            };
        });

        if (! empty($this->withRelationship)) {
            foreach (Arr::wrap($this->withRelationship) as $relationship) {
                $builder = $builder->with($relationship);
            }
        }

        if (! empty($this->scope)) {
            foreach (Arr::wrap($this->scope) as $scope) {
                $builder = $builder->$scope();
            }
        }

        $builder->orderBy($this->orderBy, $this->ascending);

        return $builder;
    }
}
