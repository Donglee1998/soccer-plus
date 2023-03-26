<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminFormCheckbox extends Component
{
    public $label;
    public $name;
    public $value;
    public $option;
    public $attribute;
    public $show;
    public $require;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $value = '', $option = [], $attribute = [], $show = true, $require = false, $class = '')
    {
        $this->label     = $label;
        $this->name      = $name;
        $this->value     = $value;
        $this->option    = $option;
        $this->attribute = $attribute;
        $this->show      = $show;
        $this->require   = '';
        $this->class     = $class;

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
        return view('components.admin.admin-form-checkbox');
    }
}
