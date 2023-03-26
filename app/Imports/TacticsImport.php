<?php

namespace App\Imports;

use App\Models\Tactic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithLimit;

HeadingRowFormatter::default('none');

class TacticsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithLimit
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tactic([
            'title'    => $row['title'],
            'explain'  => $row['explain'],
            'type'     => $row['type'],
            'status'   => $row['status'],
            'pitch'    => $row['pitch'],
        ]);
    }


    public function rules(): array
    {
        return [
            'title'    => 'required|max_mb:255',
            'explain'  => 'required|max_mb:255',
            'type'     => 'required|in:' . implode(',', config('constants.tactic_type.key')),
            'status'   => 'required|in:' . implode(',', config('constants.tactic_status.key')),
            'pitch'    => 'required|in:' . implode(',', config('constants.tactic_pitch.key')),
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        $errors = collect($failures)->map(function ($message) {
            if ($this->limit() <= $message->row()) {
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
}
