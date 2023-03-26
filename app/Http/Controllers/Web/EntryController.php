<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\EntryRequest;
use App\Repositories\RegistrationRepository;
use App\Repositories\TeamRepository;
use DB;
use Illuminate\Http\Request;

class EntryController extends BaseController
{
    protected $__registrationRepo;
    protected $__teamRepo;
    const PAGE_NAME = 'entry';

    public function __construct(RegistrationRepository $registrationRepo, TeamRepository $teamRepo)
    {
        $this->__registrationRepo = $registrationRepo;
        $this->__teamRepo = $teamRepo;
    }

    public function index(Request $request)
    {
        $data = (object) SessionInputController::getNotSubmittedData(self::PAGE_NAME);
        return view('web.entry.index', compact('data'));
    }

    public function indexPost(Request $request)
    {
        $data = (object) $request->all();
        if (!isset($data->contract_option)) {
            $data->contract_option = [];
        }
        return view('web.entry.index', compact('data'));
    }

    public function confirm(EntryRequest $request)
    {
        $data = (object) $request->all();
        if (!isset($data->contract_option)) {
            $data->contract_option = [];
        }
        SessionInputController::saveNotSubmittedData(self::PAGE_NAME, $data);
        return view('web.entry.confirm', compact('data'));
    }

    public function thanks(EntryRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = [];
            foreach (['name', 'name_furigana', 'registration_email', 'corp_name', 'corp_name_furigana',
                'zip', 'address', 'tel', 'pic_name', 'pic_name_furigana', 'pic_email',
                'pic_mobile', 'pic_birthday', 'pic_gender', 'pic_zip', 'pic_address', 'pic_tel',
                'contract_premium1', 'contract_premium2', 'contract_premium3', 'contract_option',
                'payment_method1', 'payment_method2', 'contact2_name', 'contact2_name_furigana',
                'contact2_email', 'contact2_tel', 'delivery_name', 'delivery_zip', 'delivery_address',
                'terms_checkbox'] as $field) {
                if (in_array($field, ['contract_option'])) {
                    $data[$field] = json_encode(!empty($request->$field) ? $request->$field : []);
                } elseif (in_array($field, ['pic_birthday'])) {
                    $data[$field] = "$request->pic_birthday_year-$request->pic_birthday_month-$request->pic_birthday_day";
                } elseif (in_array($field, ['zip', 'pic_zip', 'delivery_zip'])) {
                    $field_1_name = "{$field}_1";
                    $field_2_name = "{$field}_2";
                    $data[$field] = merge_zip($request->$field_1_name, $request->$field_2_name);
                } elseif (in_array($field, ['contract_premium1', 'contract_premium2', 'contract_premium3'])) {
                    $data[$field] = !empty($request->$field) ? $request->$field : null;
                } else {
                    $data[$field] = $request->$field;
                }
            }
            $data['contract_status'] = config('constants.contract_status.key.new');

            $created_record = $this->__registrationRepo->create($data);
            $team = [
                'id'          => uniqid(),
                'name'        => $created_record->corp_name,
                'is_home'     => config('constants.is_home'),
                'created_by'  => $created_record->id,
                'color_home'  => 1,
                'color_guest' => 1,
            ];
            $this->__teamRepo->create($team);

            DB::commit();
            EmailController::sendEntryInfoToAdmin($created_record);
            EmailController::sendEntryInfoToUser($created_record);
            SessionInputController::markSubmittedData(self::PAGE_NAME);
            return view('web.entry.thanks');
        } catch (\Exception $e) {
            DB::rollBack();
            EmailController::sendEntryAlertToAdmin($e, SessionInputController::getNotSubmittedData(self::PAGE_NAME));
            report($e);
            return redirect()->route('web.entry.index');
        }
    }
}
