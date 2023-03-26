<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\ContactRequest;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends BaseController
{
    protected $__contactRepo;
    const PAGE_NAME = 'contact';

    public function __construct(ContactRepository $contactRepository)
    {
        $this->__contactRepo = $contactRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = SessionInputController::getNotSubmittedData(self::PAGE_NAME);
        return view('web.contact.create', compact('data'));
    }

    /**
     * Display form contact
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ContactRequest $request)
    {
        $data = $request->only('name', 'email', 'team', 'purpose', 'app_type', 'content', 'confirm_email');
        if ($request->submit == 'back') {
            return redirect()->route('web.contact.create')->withInput();

        } elseif ($request->submit == 'confirm') {
            SessionInputController::saveNotSubmittedData(self::PAGE_NAME, $data);
            return view('web.contact.confirm', compact('data'));

        } elseif ($request->submit == 'done') {
            DB::beginTransaction();
            try {
                $created_record = $this->__contactRepo->create($data);
                EmailController::sendContactInfoToAdmin($created_record);
                EmailController::sendContactInfoToUser($created_record);

                DB::commit();
                SessionInputController::markSubmittedData(self::PAGE_NAME);
                return redirect()->route('web.contact.thanks');
            } catch (\Exception $e) {
                DB::rollBack();
                EmailController::sendContactAlertToAdmin($e, SessionInputController::getNotSubmittedData(self::PAGE_NAME));
                report($e);
            }
        }

        return redirect()->route('web.contact.create');
    }

    /**
     * Display page contact thanks
     *
     * @return \Illuminate\Http\Response
     */
    public function thanks()
    {
        return view('web.contact.thanks');
    }
}
