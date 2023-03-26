<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ContactRequest;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $__contactRepo;
    private $_view = 'admin.contact.';

    public function __construct(ContactRepository $contactRepository)
    {
        $this->__contactRepo = $contactRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $this->__contactRepo->querylist($request->all());
        return view($this->_view . 'index', compact('data'));
    }

    /**
     * Show detail of the resource
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $contact = $this->__contactRepo->find($id);
        if (empty($contact)) {
            abort(404);
        }
        return view($this->_view . 'detail', compact('contact'));
    }

    /**
     * Show form editing resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id = '')
    {
        $data = [];
        $data['type'] = config('constants.contact.type.key.admin');
        if ($id) {
            $data = $this->__contactRepo->find($id);
            if (empty($data)) {
                abort(404);
            }
        }
        return view($this->_view . 'edit', compact('data'));
    }

    /**
     * Update DB contact
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactRequest $request, $id = '')
    {
        $data = $request->get('data');
        if ($request->submit == 'back') {
            return redirect()->route('admin.contact.edit', ['id' => $id])->withInput();
        } elseif ($request->submit == 'done') {
            if ($data['purpose'] != config('constants.contact.purpose.key.app_using')) {
                $data['app_type'] = NULL;
            }
            if ($id){
                if ($data['type'] == config('constants.contact.type.key.user')) {
                    unset($data['app_type'], $data['purpose'], $data['created_at'], $data['content']);
                }
                $this->__contactRepo->update($data, $id);
            }else{
                $data['type'] = config('constants.contact.type.key.admin');
                $this->__contactRepo->create($data);
            }
        } elseif ($request->submit == 'confirm') {
            $data['id'] = $id;
            return view($this->_view . 'confirm', compact('data'));
        }

        return redirect()->route($this->_view . 'index');
    }
}
