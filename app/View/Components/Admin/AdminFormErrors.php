<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminFormErrors extends Component
{
    public $errors;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($errors = null)
    {
        $this->errors = $errors;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.admin-form-errors');
    }
}
