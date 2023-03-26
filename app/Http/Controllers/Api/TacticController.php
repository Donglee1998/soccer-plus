<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\TacticRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\MemberSheet;
use App\Models\Tactic;
use App\Http\Resources\Tactic\TacticSyncResource;
use App\Repositories\TacticRepository;
use App\Repositories\SheetRepository;

class TacticController extends Controller
{
    protected $__tacticRepo;
    protected $__sheetRepo;

    public function __construct(TacticRepository $tacticRepository, SheetRepository $sheetRepository)
    {
        $this->__tacticRepo = $tacticRepository;
        $this->__sheetRepo = $sheetRepository;
    }

    /**
     * sync data tactic
     *
     * @return \Illuminate\Http\Response
     */
    public function sync(TacticRequest $request)
    {
        try {
            if (!auth('api')->user()->has_sync_contract) {
                return $this->response(['success' => false, 'message' => config('constants.sync.no_contract_message')], 403);
            }

            DB::beginTransaction();
            $data    = $request->all();
            $user_id = auth('api')->user()->id;
            $uuid    = auth('api')->getPayload()->get('uuid');

            // sync tactic
            $condition = [
                'created_by' => $user_id,
                'tactic_id'  => $data['tactic']['id'],
                'uuid'       => $uuid,
            ];
            $tactic = $this->__tacticRepo->getTacticDetail($condition);
            $data['tactic']['tactic_id'] = $data['tactic']['id'];
            $data['tactic']['created_by'] = $user_id;
            unset($data['tactic']['id']);
            if (empty($tactic)) {
                $tactic = Tactic::create($data['tactic']);
            }else{
                $tactic->update($data['tactic']);
                $tactic->refresh();
            }

            // sync sheets
            $old_sheet = [];
            $sheets = [];
            if ($request->sheets) {
                $old_sheet = $tactic->sheets()->get();
                if ($old_sheet) {
                    foreach ($old_sheet as $sheet) {
                        Storage::disk('s3')->delete($sheet->sketch);
                        $sheet->forceDelete();
                    }
                }
                $new_sheet = collect($request->sheets)->transform(function ($sheet, $key) use($tactic) {
                    $sheet['sketch'] = move_file($sheet['sketch_image'], '/sketch');
                    unset($sheet['sketch_image']);
                    $sheet['tactic_id'] = $tactic->id;
                    $sheet['sheet_id'] = $sheet['id'];
                    unset($sheet['id']);
                    return $sheet;
                });
                $sheets = $tactic->sheets()->createMany($new_sheet);
            }

            // sync member_sheets
            $members = [];
            if ($request->member_sheet && !empty($sheets)) {
                $new_sheet_ids = $sheets->pluck('sheet_id', 'id');
                $old_sheet_ids = data_get($old_sheet, '*.id');
                MemberSheet::whereIN('sheet_id', $old_sheet_ids)->forceDelete();
                foreach ($request->member_sheet as $member_sheet) {
                    if (isset($new_sheet_ids[$member_sheet['sheet_id']])) {
                        $member_sheet['sheet_id'] = @$new_sheet_ids[$member_sheet['sheet_id']];
                        $members[] = MemberSheet::create($member_sheet);
                    }
                }
            }
            DB::commit();

            $result = [
                'tactic'  => $tactic,
                'sheets'  => $sheets,
                'members' => $members
            ];
            return $this->response($result);

        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->responseFailure($e);
        }
    }
}
