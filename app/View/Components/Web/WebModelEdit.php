<?php

namespace App\View\Components\Web;

use Illuminate\View\Component;

class WebModelEdit extends Component
{
    public $classTh;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($classTh, $title)
    {
        $this->classTh  = $classTh;
        $this->title    = $title;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.web-model-edit');
    }
}
