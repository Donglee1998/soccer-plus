<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

HeadingRowFormatter::default('none');

class MembersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithLimit, WithCustomCsvSettings
{
    use Importable;

    protected $__team_id; 
    protected $__created_by;
    protected $__enc;

    public function __construct($team_id, $created_by, $enc)
    {
        $this->__team_id = $team_id;
        $this->__created_by = $created_by;
        $this->__enc = $enc;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $positions = array_flip(config('constants.member_position.label'));
        return new Member([
            'id'              => uniqid(),
            'created_by'      => $this->__created_by,
            'team_id'         => $this->__team_id,
            'first_name'      => $row['姓'],
            'last_name'       => $row['名'],
            'number_official' => $row['背番号（公式）'],
            'number_practice' => $row['背番号（練習）'],
            'position'        => $row['ポジション'] ? @$positions[$row['ポジション']] : null,
        ]);
    }

    public function rules(): array
    {
        return [
            '姓'            => 'max_mb:255', 
            '名'            => 'max_mb:255',
            '背番号（公式）' => ['mb_required', "regex:/^[0-9]{0,3}+$/"],
            '背番号（練習）' => ['nullable', "regex:/^[0-9]{0,3}+$/"],
            'ポジション'       => ['mb_required'],
        ];
    }

    public function customValidationMessages()
    {
        return [
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $errors = collect($failures)->map(function ($message) {
            if ($message->row() >= $this->limit()) {
                return __(':limit行を超えるCSVファイルはインポートできません。', ['limit' => $this->limit()]);
            }
            return __('【:row行目】:message', ['row' => $message->row(), 'message' => $message->errors()[0]]);
        })->all();
        throw new HttpResponseException(response()->json($errors[0], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function limit(): int
    {
        return 1000; // only take 1000 rows
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => $this->__enc
        ];
    }
}
