<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminForm extends Component
{
    public $method;
    public $action;
    public $btnSubmit;
    public $class;
    public $showBtnSubmit;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($method = 'post', $action = '', $btnSubmit = '入力内容を確認', $class = "", $showBtnSubmit = 'show')
    {
        $this->method    = $method;
        $this->action    = empty($action) ? url()->current() : $action;
        $this->btnSubmit = $btnSubmit;
        $this->class     = $class;
        $this->showBtnSubmit = $showBtnSubmit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.admin-form');
    }
}
