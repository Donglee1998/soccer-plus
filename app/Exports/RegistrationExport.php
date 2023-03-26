<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RegistrationExport implements FromCollection, WithHeadings, WithMapping, WithCustomCsvSettings
{
    protected $__collection;

    public function __construct($collection)
    {
        $this->__collection = $collection;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->__collection;
    }

    public function getCsvSettings(): array
    {
        return [
            'enclosure' => '"',
            'use_bom'   => true,
        ];
    }

    /**
     * Add heading
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'チーム名',
            '代表者',
            '種類',
            '最終更新'
        ];
    }

    /**
     * Mapping data.
     *
     * @return array
     */
    public function map($model): array
    {
        return [
            $model->id,
            $model->team_name,
            $model->representative_lastname.$model->representative_firstname,
            @config('constants.registration_type')[$model->type],
            format_date($model->updated_at, 'Y/m/d H:i')
        ];
    }
}
