<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->model = app()->make($this->model());
    }

    /**
     * get model.
     * @return string
     */
    abstract public function model();

    /**
     * Retrieve all data of repository.
     */
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    /**
     * Retrieve all data of repository.
     */
    public function list($condition, $columns = ['*'])
    {
        $builder = $this->model;
        $builder = $builder->orderByDesc('id');
        $builder = $builder->select($columns);
        if (config('constants.limit')) {
            return $builder->paginate(config('constants.limit'))->appends($condition);
        }

        return $builder->get();
    }

    /**
     * Retrieve all data of repository, paginated.
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? config('constants.limit') : $limit;

        return $this->model->paginate($limit, $columns);
    }

    /**
     * Find data by id.
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Save a new entity in repository.
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Update a entity in repository by id.
     */
    public function update($input, $id)
    {
        $model = $this->model->find($id);
        $model->fill($input);

        return $model->save();
    }

    /**
     * Delete a entity in repository by id.
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Destroy the mass resources.
     *
     * @param array $ids
     * @return bool
     */
    public function massDestroy(array $ids)
    {
        return $this->model->whereIn('id', $ids)->forceDelete();
    }

    /**
     * Trash the mass resourece.
     *
     * @param array $ids
     * @return bool
     */
    public function massTrash(array $ids)
    {
        return $this->model->whereIn('id', $ids)->delete();
    }

    public function createLogInput($input, $old_record){
        $history = [];
        $changes = $input->getChanges();
        unset($changes['updated_at']);
        if ($changes) {
            foreach ($changes as $column => $new_value) {
                $history[$column] = [$old_record->$column, $new_value];
            }
        }
        return $history;
    }


    protected function __updateMultipleGlobal(
        $model,
        array $values,
        $primaryKey = ''
    ) {
        $ids = [];
        $params = [];
        $columns_groups = [];
        $query_start = "UPDATE {$model->getTable()} SET";
        $key_table = $primaryKey ? $primaryKey : 'id';
        $arr_values = $values;
        $columns_names = array_keys($values[0]);
        foreach ($columns_names as $column_name) {
            $cases = [];
            $column_group =
                '`' . $column_name . '` = (CASE ' . $key_table . ' ';
            foreach ($arr_values as $new_data) {
                $id = "'" . $new_data[$key_table] . "'";
                $cases[] = "WHEN {$id} then ?";
                $ids[$id] = '0';
                unset($new_data[$key_table]);
                if ($column_name != $key_table) {
                    if (
                        $new_data[$column_name] == '' &&
                        $new_data[$column_name] != 0
                    ) {
                        $val_param = null;
                    } else {
                        $val_param = is_numeric($new_data[$column_name])
                            ? (int) $new_data[$column_name]
                            : $new_data[$column_name];
                    }
                    $params[] = $val_param;
                }
            }
            $cases = implode(' ', $cases);
            if ($column_name != $key_table) {
                $columns_groups[] = $column_group . "{$cases} END)";
            }
        }

        $ids = implode(',', array_keys($ids));
        $columns_groups = implode(',', $columns_groups);

        $params[] = Carbon::now();
        $query_end = ', updated_at = ? WHERE ' . $key_table . " in ({$ids})";
        return DB::update($query_start . $columns_groups . $query_end, $params);
    }

      /**
     * insertMultipleGlobal
     *
     * @param $model
     * @param array $values
     */
    protected function __insertMultipleGlobal($model, array $values)
    {
       return $model->newQuery()->insert($values);
    }
}
