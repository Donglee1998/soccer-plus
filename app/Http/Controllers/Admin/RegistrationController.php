<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RegistrationExport;
use App\Http\Requests\Admin\RegistrationRequest;
use App\Repositories\RegistrationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    protected $__registrationRepo;

    public function __construct(RegistrationRepository $registrationRepo)
    {
        $this->__registrationRepo = $registrationRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->__registrationRepo->querylist($request);

        return view('admin.registration.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = null)
    {
        $data = [];
        $data['id']      = $id;
        $data = $this->__registrationRepo->find($id);
        if (!$data) {
            return redirect()->route('admin.registration.index');
        }
        $data['contract_option'] = json_decode($data['contract_option']);

        return view('admin.registration.edit', compact('data'));
    }

    /**
     * Confirm the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editConfirm(RegistrationRequest $request, $id = null)
    {
        $data = $request->get('data');
        $data['id'] = $id;

        return view('admin.registration.confirm', compact('data'));
    }

    /**
     * Create or Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editStore(RegistrationRequest $request, $id = null)
    {
        if ($request->has('data')) {
            $data = $request->get('data');
            if ($request->submit === 'back') {
                return redirect()->route('admin.registration.edit', ['id' => $id])->withInput();
            } elseif ($request->submit === 'done') {
                DB::beginTransaction();
                try {
                    if (empty($data['password'])) {
                        unset($data['password']);
                    } else {
                        $data['password'] = \Hash::make($data['password']);
                    }
                    if (empty($data['password_confirm'])) {
                        unset($data['password_confirm']);
                    } else {
                        $data['password_confirm'] = \Hash::make($data['password_confirm']);
                    }
                    if (empty($data['contract_option'])) {
                        $data['contract_option'] = [];
                    }
                    $this->__registrationRepo->update($data, $id);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    report($e);
                }
            }
        }

        return redirect()->route('admin.registration.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        try {
            $registration = $this->__registrationRepo->find($id);

            if ($registration) {
                $this->__registrationRepo->delete($id);

                return $this->jsonData(['redirect_url' => route('admin.registration.index')]);
            }
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        try {
            $this->__registrationRepo->massTrash($request->ids);

            return $this->jsonData(['success' => true]);
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }

    /**
     * Export resource to csv
     *
     * @return \Illuminate\Http\Response
     */
    public function exportCsv()
    {
        try {
            $filename = 'registration_' . date('dmY') . '.csv';
            $registrations = $this->__registrationRepo->all();

            return \Excel::download(new RegistrationExport($registrations), $filename);
        } catch (\Exception $e) {
            report($e);
            return $this->jsonError($e);
        }
    }
}
