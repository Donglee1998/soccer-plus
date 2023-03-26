<?php

namespace App\View\Components\Web;

use Illuminate\View\Component;

class WebPopupLoading extends Component
{
    public $display;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($display)
    {
        $this->display = $display;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.web-popup-loading');
    }
}
