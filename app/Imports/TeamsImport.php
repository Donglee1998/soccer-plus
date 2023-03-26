<?php

namespace App\Imports;

use App\Models\Team;
use App\Repositories\TeamRepository;
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

HeadingRowFormatter::default('none');

class TeamsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithLimit
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $teamRepo = new TeamRepository();
        return new Team([
            'name'         => $row['チーム名'],
            'abbreviation' => $row['略称'],
            'color_home'   => $row['チームカラー(ホーム)'],
            'color_guest'  => $row['チームカラー(アウェイ)'],
            'gender'       => $row['チーム性別'],
            'hometown'     => $row['ホームタウン'],
            'supervisor'   => $row['監督'],
            'coach'        => $row['コーチ'],
            'manager'      => $row['マネージャー'],
            'trainer'      => $row['トレーナー'],
            'explanation'  => $row['説明'],
            'order'        => $teamRepo->getOrder()
        ]);
    }

    public function rules(): array
    {
        return [
            'チーム名'         => ['mb_required', 'max_mb:255', Rule::unique('teams', 'name')->where('created_by', auth('api')->user()->id)->whereNull('deleted_at')],
            '略称'           => 'max_mb:255',
            'チームカラー(ホーム)'  => 'required|team_color',
            'チームカラー(アウェイ)' => 'required|team_color',
            'チーム性別'        => 'nullable|member_gender',
            'ホームタウン'       => 'max_mb:255',
            '監督'           => 'max_mb:255',
            'コーチ'           => 'max_mb:255',
            'マネージャー'       => 'max_mb:255',
            'トレーナー'        => 'max_mb:255',
            '説明'           => 'max_mb:1000',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'チームカラー(ホーム).team_color'  => ':attributeは無効な値です。',
            'チームカラー(アウェイ).team_color' => ':attributeは無効な値です。',
            'チーム性別.member_gender'     => ':attributeは無効な値です。',
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
}
