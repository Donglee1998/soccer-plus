<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminFormButton extends Component
{
    public $btnSubmit;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($btnSubmit = '入力内容を確認')
    {
        $this->btnSubmit = $btnSubmit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.admin-form-button');
    }
}
