<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminFormSelect extends Component
{
    public $label;
    public $name;
    public $value;
    public $option;
    public $attribute;
    public $show;
    public $require;
    public $centerLabel;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $value = '', $option = [], $attribute = [], $show = true, $require = false, $centerLabel = false)
    {
        $this->label     = $label;
        $this->name      = $name;
        $this->value     = $value;
        $this->option    = $option;
        $this->attribute = $attribute;
        $this->show      = $show;
        $this->require   = '';
        $this->centerLabel = $centerLabel;

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
        return view('components.admin.admin-form-select');
    }
}
