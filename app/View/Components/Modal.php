<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title;

    public $saveBtnText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $saveBtnText = null)
    {
        $this->title = $title;
        $this->saveBtnText = $saveBtnText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
