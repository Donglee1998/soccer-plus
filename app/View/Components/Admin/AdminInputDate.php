<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminInputDate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $value = '')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.admin-input-date');
    }
}
