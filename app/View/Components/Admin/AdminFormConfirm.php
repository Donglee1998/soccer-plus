<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminFormConfirm extends Component
{
    public $method;
    public $action;
    public $btnSubmit;
    public $btnBack;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($method = 'post', $action = '', $btnSubmit = '登録', $btnBack = '戻る')
    {
        $this->method     = $method;
        $this->action     = empty($action) ? url()->current() : $action;
        $this->btnSubmit  = $btnSubmit;
        $this->btnBack    = $btnBack;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.admin-form-confirm');
    }
}
