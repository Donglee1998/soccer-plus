<?php

namespace App\View\Components\Web;

use Illuminate\View\Component;

class WebModelAdminPassword extends Component
{
    public $classTh;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($classTh)
    {
        $this->classTh    = $classTh;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.web-model-admin-password');
    }
}
