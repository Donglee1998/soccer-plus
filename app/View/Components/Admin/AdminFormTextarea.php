<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminFormTextarea extends Component
{
    public $label;
    public $name;
    public $value;
    public $require;
    public $disable;
    public $borderNone;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $value = '', $require = false, $disable = '', $borderNone = '')
    {
        $this->label    = $label;
        $this->name     = $name;
        $this->value    = $value;
        $this->require  = '';
        $this->disable  = $disable;
        $this->borderNone   = $borderNone;

        if ($require) {
            $this->require = '<span class="red">[必須]</span>';
        }
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.admin-form-textarea');
    }
}
