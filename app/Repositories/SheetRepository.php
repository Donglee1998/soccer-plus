<?php
namespace App\Repositories;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Interfaces\SheetRepositoryInteface;

class SheetRepository extends BaseRepository implements SheetRepositoryInteface
{
    public function model()
    {
        return \App\Models\Sheet::class;
    }

    public function getListSync($condition = [])
    {
        $builder = $this->model;
        $builder = $builder->select('id', 'sheet_id');
        if (@$condition['tactic_id']) {
            $builder = $builder->whereIN('tactic_id', $condition['tactic_id']);
        }
        if (@$condition['uuid']) {
            $builder = $builder->where('uuid', $condition['uuid']);
        }
        $builder = $builder->pluck('id', 'sheet_id')->toArray();
        return $builder;
    }

    public function deleteSheetFollowTactic($condition = [])
    {
        $builder = $this->model;

        if (!empty($condition['array_id_tactic']) && !empty($condition['created_by'])) {
            $sheets = $builder->whereIn('tactic_id', $condition['array_id_tactic'])->get();
            foreach ($sheets as $key => $sheet){
                Storage::disk('s3')->delete($sheet->sketch);
                $sheet->delete();
            }
        }

        return true;
    }
}
