<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class AdminFormText extends Component
{
    public $type;
    public $label;
    public $name;
    public $value;
    public $attribute;
    public $show;
    public $hidden;
    public $require;
    public $class;
    public $styleLabel;
    public $centerLabel;
    public $disable;
    public $borderNone;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $value = '', $type = 'text', $attribute = [], $show = true, $require = false, $hidden = false, $class = '',$styleLabel = '',$centerLabel = false, $disable = '', $borderNone = '')
    {
       
        $this->label        = $label;
        $this->name         = $name;
        $this->value        = $value;
        $this->type         = $type;
        $this->attribute    = $attribute;
        $this->show         = $show;
        $this->hidden       = $hidden;
        $this->require      = '';
        $this->class        = $class;
        $this->styleLabel   = $styleLabel;
        $this->centerLabel  = $centerLabel;
        $this->disable      = $disable;
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
        return view('components.admin.admin-form-text');
    }
}
