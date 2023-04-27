<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title;

    public $saveBtnText;
    public $saveBtnType;
    public $saveBtnForm;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = null, 
        $saveBtnText = null,
        $saveBtnType = null,
        $saveBtnForm = null
    )
    {
        $this->title = $title;
        $this->saveBtnText = $saveBtnText;
        $this->saveBtnType = $saveBtnType;
        $this->saveBtnForm = $saveBtnForm;
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
